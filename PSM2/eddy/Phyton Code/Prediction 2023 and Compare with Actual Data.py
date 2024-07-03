import pandas as pd
import numpy as np
from xgboost import XGBRegressor
from sklearn.ensemble import RandomForestRegressor
from sklearn.metrics import mean_absolute_error, mean_squared_error, r2_score
from sklearn.model_selection import GridSearchCV, TimeSeriesSplit
import matplotlib.pyplot as plt
import matplotlib.gridspec as gridspec
import seaborn as sns
import os

# Function to read and preprocess data
def read_and_preprocess_data(data_file, exclude_year=None):
    data = pd.read_csv(data_file)
    
    month_mapping = {
        'January': 1, 'February': 2, 'March': 3, 'April': 4, 
        'May': 5, 'June': 6, 'July': 7, 'August': 8, 
        'September': 9, 'October': 10, 'November': 11, 'December': 12,
        'Jan': 1, 'Feb': 2, 'Mar': 3, 'Apr': 4,
        'May': 5, 'Jun': 6, 'Jul': 7, 'Aug': 8,
        'Sep': 9, 'Oct': 10, 'Nov': 11, 'Dec': 12
    }
    
    data['Month_Num'] = data['Month'].map(month_mapping)
    
    if exclude_year is not None:
        data = data[data['Year'] != exclude_year]
    
    return data

# Function for feature engineering
def prepare_data(data, variable):
    # Create lagged features
    for var in ['Temperature', 'Humidity', 'Rainfall', 'Wind Speed']:
        data[f'{var}_lag1'] = data.groupby('Year')[var].shift(1)
        data[f'{var}_lag2'] = data.groupby('Year')[var].shift(2)

    # Create rolling averages
    for var in ['Temperature', 'Humidity', 'Rainfall', 'Wind Speed']:
        data[f'{var}_rolling3'] = data.groupby('Year')[var].rolling(window=3, min_periods=1).mean().reset_index(0, drop=True)

    # Create seasonality features
    data['month_sin'] = np.sin(2 * np.pi * data['Month_Num']/12)
    data['month_cos'] = np.cos(2 * np.pi * data['Month_Num']/12)

    # Create interaction terms
    data['temp_humid'] = data['Temperature'] * data['Humidity']

    # Filter for the specific variable
    y = data[variable]
    X = data.drop(['Year', 'Month', variable, 'Temperature', 'Humidity', 'Rainfall', 'Wind Speed'], axis=1)

    # Handle NaN and infinity values
    X = X.replace([np.inf, -np.inf], np.nan)
    X = X.fillna(X.mean())
    y = y.fillna(y.mean())

    return X, y

# Function to check data quality
def check_data_quality(X, y):
    print("Checking for NaN or infinity values:")
    print("X contains NaN:", X.isna().any().any())
    print("y contains NaN:", y.isna().any())
    print("X contains infinity:", np.isinf(X).any().any())
    print("y contains infinity:", np.isinf(y).any())

# Function to train RandomForest models with hyperparameter tuning
def train_model(X_train, y_train):
    param_grid = {
        'n_estimators': [100, 200, 300],
        'max_depth': [None, 10, 20, 30],
        'min_samples_split': [2, 5, 10],
        'min_samples_leaf': [1, 2, 4]
    }
    
    rf = RandomForestRegressor(random_state=42)
    
    grid_search = GridSearchCV(estimator=rf, param_grid=param_grid, 
                               cv=5, n_jobs=-1, verbose=2, scoring='neg_mean_squared_error')
    
    grid_search.fit(X_train, y_train)
    
    print("Best parameters for Random Forest:", grid_search.best_params_)
    return grid_search.best_estimator_

# Function to train XGBoost models with hyperparameter tuning
def train_xgboost_model(X_train, y_train):
    param_grid = {
        'n_estimators': [100, 200, 300],
        'learning_rate': [0.01, 0.1, 0.3],
        'max_depth': [3, 5, 7],
        'min_child_weight': [1, 3, 5]
    }
    
    xgb = XGBRegressor(random_state=42)
    
    grid_search = GridSearchCV(estimator=xgb, param_grid=param_grid, 
                               cv=5, n_jobs=-1, verbose=2, scoring='neg_mean_squared_error')
    
    grid_search.fit(X_train, y_train)
    
    print("Best parameters for XGBoost:", grid_search.best_params_)
    return grid_search.best_estimator_

# Function to predict values
def predict(model, X):
    return model.predict(X)

# Function to evaluate predictions against actual data
def evaluate(predictions, actual_data):
    mae = mean_absolute_error(actual_data, predictions)
    rmse = np.sqrt(mean_squared_error(actual_data, predictions))
    r2 = r2_score(actual_data, predictions)
    
    metrics = {'MAE': mae, 'RMSE': rmse, 'R-squared': r2}
    return metrics

# Function to evaluate with cross-validation
def evaluate_with_cv(X, y, model, n_splits=5):
    tscv = TimeSeriesSplit(n_splits=n_splits)
    metrics = {'MAE': [], 'RMSE': [], 'R-squared': []}
    
    for train_index, test_index in tscv.split(X):
        X_train, X_test = X.iloc[train_index], X.iloc[test_index]
        y_train, y_test = y.iloc[train_index], y.iloc[test_index]
        
        model.fit(X_train, y_train)
        predictions = model.predict(X_test)
        
        fold_metrics = evaluate(predictions, y_test)
        for key in metrics:
            metrics[key].append(fold_metrics[key])
    
    # Average the metrics across folds
    return {key: np.mean(values) for key, values in metrics.items()}

# New function to create combined plots
def create_combined_plots(predictions, actual_data, months, variables, location, models, save_dir, metrics):
    fig = plt.figure(figsize=(20, 20))
    gs = gridspec.GridSpec(4, 2, figure=fig)
    
    for i, variable in enumerate(variables):
        for j, model in enumerate(models):
            ax = fig.add_subplot(gs[i, j])
            
            ax.plot(months, actual_data[variable], marker='o', linestyle='-', color='b', label='Actual')
            ax.plot(months, predictions[f'{variable}_{model}'], marker='o', linestyle='--', color='r', label='Predicted')
            
            ax.set_xlabel('Month')
            ax.set_ylabel(variable)
            ax.set_title(f'{variable} - {model}')
            ax.set_xticks(range(1, 13))
            ax.set_xticklabels([str(month) for month in range(1, 13)], rotation=45)
            ax.legend()
            ax.grid(True)

            metrics_text = f"MAE: {metrics[f'{variable}_{model}']['MAE']:.2f}\n" \
                           f"RMSE: {metrics[f'{variable}_{model}']['RMSE']:.2f}\n" \
                           f"R-squared: {metrics[f'{variable}_{model}']['R-squared']:.2f}"
            ax.text(0.95, 0.05, metrics_text, transform=ax.transAxes, 
                    bbox=dict(facecolor='white', alpha=0.8), fontsize=8, 
                    verticalalignment='bottom', horizontalalignment='right')

    plt.tight_layout()
    
    os.makedirs(save_dir, exist_ok=True)
    plot_filename = os.path.join(save_dir, f'{location}_combined_predictions.png')
    plt.savefig(plot_filename, dpi=300, bbox_inches='tight')
    plt.close()

    print(f"Combined plot for {location} has been saved to '{plot_filename}'")

# Function to create and save the accuracy results table
def create_accuracy_tables(results_df, save_dir):
    for location in ['Johor Bahru', 'Melaka']:
        plt.figure(figsize=(12, 8))
        sns.set(font_scale=1.1)
        
        # Filter data for the specific location
        location_data = results_df[results_df['Location'] == location]
        
        # Pivot the dataframe to create a table-like structure
        table_data = location_data.pivot_table(
            values=['MAE', 'RMSE', 'R-squared'],
            index=['Variable'],
            columns='Model',
            aggfunc='first'
        )
        
        # Flatten column multi-index
        table_data.columns = [f'{col[1]} - {col[0]}' for col in table_data.columns]
        
        # Create the heatmap (table)
        sns.heatmap(table_data, annot=True, fmt='.3f', cmap='YlGnBu', linewidths=0.5, cbar=False)
        
        plt.title(f'Accuracy Results Table - {location}', fontsize=16)
        plt.tight_layout()
        
        # Save the table as a PNG file
        table_filename = os.path.join(save_dir, f'accuracy_results_table_{location}.png')
        plt.savefig(table_filename, dpi=300, bbox_inches='tight')
        plt.close()
        
        print(f"Accuracy results table for {location} has been saved to '{table_filename}'")
    
def create_correlation_matrix(data, save_dir):
    plt.figure(figsize=(10, 8))
    corr_matrix = data[['Temperature', 'Humidity', 'Rainfall', 'Wind Speed']].corr()
    sns.heatmap(corr_matrix, annot=True, cmap='coolwarm', vmin=-1, vmax=1, center=0)
    plt.title('Correlation Matrix of Climate Variables')
    plt.tight_layout()
    
    matrix_filename = os.path.join(save_dir, 'correlation_matrix.png')
    plt.savefig(matrix_filename, dpi=300, bbox_inches='tight')
    plt.close()
    
    print(f"Correlation matrix has been saved to '{matrix_filename}'")

# Modified main function
def main():
    locations = {
        'Johor Bahru': {
            'historical_data_file': 'historical_data_jb_2022.csv',
            'actual_data_file': 'actual_data_jb_2023.csv',
            'save_dir': 'C:/Users/MSI/Documents/PSM/TRAINING/TRAINING/Dashboard/Johor Bahru'
        },
        'Melaka': {
            'historical_data_file': 'historical_data_melaka_2022.csv',
            'actual_data_file': 'actual_data_melaka_2023.csv',
            'save_dir': 'C:/Users/MSI/Documents/PSM/TRAINING/TRAINING/Dashboard/Melaka'
        }
    }

    variables = ['Temperature', 'Humidity', 'Rainfall', 'Wind Speed']
    
    results_df = pd.DataFrame(columns=['Location', 'Variable', 'Model', 'MAE', 'RMSE', 'R-squared'])
    
    for location, files in locations.items():
        print(f"Processing data for {location}...")
        
        historical_data = read_and_preprocess_data(files['historical_data_file'], exclude_year=2023)
        create_correlation_matrix(historical_data, files['save_dir'])
        
        actual_data_2023 = read_and_preprocess_data(files['actual_data_file'])
        
        all_predictions = {}
        all_metrics = {}
        
        for variable in variables:
            print(f"Processing {variable} for {location}...")
            
            X, y = prepare_data(historical_data, variable)
            X_2023, y_2023 = prepare_data(actual_data_2023, variable)
            
            check_data_quality(X, y)
            
            rf_model = train_model(X, y)
            xgb_model = train_xgboost_model(X, y)
            
            rf_cv_metrics = evaluate_with_cv(X, y, rf_model)
            xgb_cv_metrics = evaluate_with_cv(X, y, xgb_model)
            
            results_df = results_df.append({
                'Location': location,
                'Variable': variable,
                'Model': 'RandomForest (CV)',
                'MAE': rf_cv_metrics['MAE'],
                'RMSE': rf_cv_metrics['RMSE'],
                'R-squared': rf_cv_metrics['R-squared']
            }, ignore_index=True)
            
            results_df = results_df.append({
                'Location': location,
                'Variable': variable,
                'Model': 'XGBoost (CV)',
                'MAE': xgb_cv_metrics['MAE'],
                'RMSE': xgb_cv_metrics['RMSE'],
                'R-squared': xgb_cv_metrics['R-squared']
            }, ignore_index=True)
            
            rf_predictions_2023 = predict(rf_model, X_2023)
            xgb_predictions_2023 = predict(xgb_model, X_2023)
            
            all_predictions[f'{variable}_RandomForest'] = rf_predictions_2023
            all_predictions[f'{variable}_XGBoost'] = xgb_predictions_2023
            
            rf_evaluation_metrics = evaluate(rf_predictions_2023, y_2023)
            xgb_evaluation_metrics = evaluate(xgb_predictions_2023, y_2023)
            
            all_metrics[f'{variable}_RandomForest'] = rf_evaluation_metrics
            all_metrics[f'{variable}_XGBoost'] = xgb_evaluation_metrics
            
            results_df = results_df.append({
                'Location': location,
                'Variable': variable,
                'Model': 'RandomForest (2023)',
                'MAE': rf_evaluation_metrics['MAE'],
                'RMSE': rf_evaluation_metrics['RMSE'],
                'R-squared': rf_evaluation_metrics['R-squared']
            }, ignore_index=True)
            
            results_df = results_df.append({
                'Location': location,
                'Variable': variable,
                'Model': 'XGBoost (2023)',
                'MAE': xgb_evaluation_metrics['MAE'],
                'RMSE': xgb_evaluation_metrics['RMSE'],
                'R-squared': xgb_evaluation_metrics['R-squared']
            }, ignore_index=True)
        
        create_combined_plots(all_predictions, actual_data_2023, actual_data_2023['Month_Num'], 
                              variables, location, ['RandomForest', 'XGBoost'], 
                              files['save_dir'], all_metrics)
    
     # Create and save the accuracy results table
    create_accuracy_tables(results_df, 'C:/Users/MSI/Documents/PSM/TRAINING/TRAINING/Dashboard')
    
    # Save the results to a CSV file
    results_df.to_csv('accuracy_results.csv', index=False)
    print("\nAccuracy results have been saved to 'accuracy_results.csv'")

if __name__ == "__main__":
    main()                      