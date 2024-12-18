// import React from "react";
// import { ResponsiveBar } from "@nivo/bar";
// import scholarData from "../data/scraped_scholar_data.json"; // Adjust the path as necessary

// const HIndexCitationsBarChart = () => {
//   // Calculate totals for H-index and Citations
//   const totalHIndex = scholarData.reduce(
//     (sum, entry) => sum + (entry["H-INDEXED (SCOPUS)"] || 0),
//     0
//   );
//   const totalCitations = scholarData.reduce(
//     (sum, entry) => sum + (entry["CITATIONS (SCOPUS)"] || 0),
//     0
//   );

//   // Prepare data for the bar chart
//   const data = [
//     { type: "H-Index", count: totalHIndex },
//     { type: "Citations", count: totalCitations },
//   ];

//   return (
//     <div style={{ height: "80%", width: "100%", margin: "auto" }}>
//       <h2 style={{ textAlign: "center" }}>H-Index and Citations Overview</h2>
//       <ResponsiveBar
//         data={data}
//         keys={["count"]}
//         indexBy="type"
//         margin={{ top: 50, right: 50, bottom: 50, left: 60 }}
//         padding={0.3}
//         colors={{ scheme: "set2" }}
//         borderColor={{
//           from: "color",
//           modifiers: [["darker", 1.6]],
//         }}
//         axisTop={null}
//         axisRight={null}
//         axisBottom={{
//           tickSize: 5,
//           tickPadding: 5,
//           tickRotation: 0,
//           legend: "Metric Type",
//           legendPosition: "middle",
//           legendOffset: 32,
//         }}
//         axisLeft={{
//           tickSize: 5,
//           tickPadding: 5,
//           tickRotation: 0,
//           legend: "Count",
//           legendPosition: "middle",
//           legendOffset: -40,
//         }}
//         labelSkipWidth={12}
//         labelSkipHeight={12}
//         labelTextColor={{
//           from: "color",
//           modifiers: [["darker", 1.6]],
//         }}
//         role="application"
//         ariaLabel="Bar chart of H-index and citations"
//       />
//     </div>
//   );
// };

// export default HIndexCitationsBarChart;

// import React from "react";
// import { ResponsiveBar } from "@nivo/bar";
// import scholarData from "../data/scraped_scholar_data.json"; // Adjust the path as necessary

// const StackedBarChart = () => {
//   // Prepare the data for the stacked bar chart
//   const data = scholarData.map((scholar, index) => ({
//     scholar: index + 1, // Use scholar number (1 to 100)
//     hIndex: scholar["H-INDEXED (SCOPUS)"] || 0,
//     citations: scholar["CITATIONS (SCOPUS)"] || 0,
//     publications: scholar["PUBLICATIONS"] || 0,
//   }));

//   return (
//     <div style={{ height: "90%", width: "100%", margin: "auto" }}>
//       <h2 style={{ textAlign: "center" }}>
//         Metrics Comparison Across Scholars
//       </h2>
//       <ResponsiveBar
//         data={data}
//         keys={["hIndex", "citations", "publications"]} // Metrics to stack
//         indexBy="scholar" // Use scholar numbers as x-axis
//         margin={{ top: 50, right: 130, bottom: 50, left: 60 }}
//         padding={0.3}
//         groupMode="stacked" // Enables stacked bars
//         colors={{ scheme: "set2" }} // Bright color scheme
//         borderColor={{
//           from: "color",
//           modifiers: [["darker", 1.6]],
//         }}
//         axisTop={null}
//         axisRight={null}
//         axisBottom={{
//           tickSize: 5,
//           tickPadding: 5,
//           tickRotation: 0,
//           legend: "Scholars (1-100)",
//           legendPosition: "middle",
//           legendOffset: 32,
//           tickValues: Array.from({ length: 20 }, (_, i) => i * 5 + 1), // Gap of 5
//         }}
//         axisLeft={{
//           tickSize: 5,
//           tickPadding: 5,
//           tickRotation: 0,
//           legend: "Metrics",
//           legendPosition: "middle",
//           legendOffset: -40,
//         }}
//         labelSkipWidth={12}
//         labelSkipHeight={12}
//         labelTextColor={{
//           from: "color",
//           modifiers: [["darker", 1.6]],
//         }}
//         tooltip={({ id, value }) => (
//           <div
//             style={{
//               padding: "5px 10px",
//               color: "white",
//               background: "#333",
//               borderRadius: "3px",
//             }}
//           >
//             <strong>{id}</strong>: {value}
//           </div>
//         )}
//         legends={[
//           {
//             dataFrom: "keys",
//             anchor: "bottom-right",
//             direction: "column",
//             justify: false,
//             translateX: 120,
//             translateY: 0,
//             itemsSpacing: 2,
//             itemWidth: 100,
//             itemHeight: 20,
//             itemDirection: "left-to-right",
//             itemOpacity: 0.85,
//             symbolSize: 20,
//             effects: [
//               {
//                 on: "hover",
//                 style: {
//                   itemOpacity: 1,
//                 },
//               },
//             ],
//           },
//         ]}
//         role="application"
//         ariaLabel="Stacked bar chart for scholar metrics"
//       />
//     </div>
//   );
// };

// export default StackedBarChart;

import React from "react";
import { ResponsiveBar } from "@nivo/bar";
import scholarData from "../data/scraped_scholar_data.json"; // Adjust the path as necessary

const StackedBarChart = () => {
  // Prepare the data for the stacked bar chart
  const data = scholarData.map((scholar, index) => ({
    scholar: index + 1, // Use scholar number (1 to 100)
    hIndex: scholar["H-INDEXED (SCOPUS)"] || 0,
    citations: scholar["CITATIONS (SCOPUS)"] || 0,
    publications: scholar["PUBLICATIONS"] || 0,
  }));

  return (
    <div style={{ height: "80%", width: "100%", margin: "auto" }}>
      <h2 style={{ textAlign: "center" }}>
        Metrics Comparison Across Scholars
      </h2>
      <ResponsiveBar
        data={data}
        keys={["hIndex", "citations", "publications"]} // Metrics to stack
        indexBy="scholar" // Use scholar numbers as x-axis
        margin={{ top: 50, right: 130, bottom: 50, left: 60 }}
        padding={0.3}
        groupMode="stacked" // Enables stacked bars
        colors={{ scheme: "set2" }} // Bright color scheme
        borderColor={{
          from: "color",
          modifiers: [["darker", 1.6]],
        }}
        axisTop={null}
        axisRight={null}
        axisBottom={{
          tickSize: 5,
          tickPadding: 5,
          tickRotation: 0,
          legend: "Scholars (1-100)",
          legendPosition: "middle",
          legendOffset: 32,
          tickValues: Array.from({ length: 20 }, (_, i) => i * 5 + 1), // Gap of 5
        }}
        axisLeft={{
          tickSize: 5,
          tickPadding: 5,
          tickRotation: 0,
          legend: "Metrics",
          legendPosition: "middle",
          legendOffset: -40,
        }}
        label={({ value }) => value} // Display numbers in each segment
        labelSkipWidth={0} // Ensure all labels are shown
        labelSkipHeight={0} // Ensure all labels are shown
        labelTextColor="black" // Set label color for visibility
        tooltip={({ id, value }) => (
          <div
            style={{
              padding: "5px 10px",
              color: "white",
              background: "#333",
              borderRadius: "3px",
            }}
          >
            <strong>{id}</strong>: {value}
          </div>
        )}
        legends={[
          {
            dataFrom: "keys",
            anchor: "bottom-right",
            direction: "column",
            justify: false,
            translateX: 120,
            translateY: 0,
            itemsSpacing: 2,
            itemWidth: 100,
            itemHeight: 20,
            itemDirection: "left-to-right",
            itemOpacity: 0.85,
            symbolSize: 20,
            effects: [
              {
                on: "hover",
                style: {
                  itemOpacity: 1,
                },
              },
            ],
          },
        ]}
        role="application"
        ariaLabel="Stacked bar chart for scholar metrics"
      />
    </div>
  );
};

export default StackedBarChart;
