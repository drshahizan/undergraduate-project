import { ResponsivePie } from "@nivo/pie";
import scholarData from "../data/scraped_scholar_data.json";

const HIndexCitationsPieChart = () => {
  // Prepare the data for the pie chart
  const data = [
    {
      id: "H-Index",
      value: scholarData.reduce(
        (sum, item) => sum + (item["H-INDEXED (SCOPUS)"] || 0),
        0
      ),
    },
    {
      id: "Citations",
      value: scholarData.reduce(
        (sum, item) => sum + (item["CITATIONS (SCOPUS)"] || 0),
        0
      ),
    },
  ];

  // Calculate the total for percentage calculation
  const total = data.reduce((sum, entry) => sum + entry.value, 0);

  // Add percentage labels
  const dataWithPercentage = data.map((item) => ({
    ...item,
    label: `${((item.value / total) * 100).toFixed(1)}%`,
  }));

  return (
    <div style={{ height: "400px", width: "800px", margin: "auto" }}>
      <ResponsivePie
        data={dataWithPercentage}
        margin={{ top: 40, right: 80, bottom: 80, left: 80 }}
        innerRadius={0} // Full pie chart
        padAngle={1} // Spacing between slices
        cornerRadius={3}
        colors={{ scheme: "set2" }} // Bright color scheme
        borderWidth={1}
        borderColor={{
          from: "color",
          modifiers: [["darker", 0.2]],
        }}
        arcLinkLabelsSkipAngle={10}
        arcLinkLabelsTextColor="#333333"
        arcLinkLabelsThickness={2}
        arcLinkLabelsColor={{ from: "color" }}
        arcLabelsSkipAngle={10}
        arcLabelsTextColor={{
          from: "color",
          modifiers: [["darker", 2]],
        }}
        tooltip={({ datum }) => (
          <div
            style={{
              padding: "5px 10px",
              color: "white",
              background: datum.color,
              borderRadius: "3px",
            }}
          >
            <strong>{datum.id}</strong>: {datum.value} ({datum.label})
          </div>
        )}
        legends={[
          {
            anchor: "bottom",
            direction: "row",
            justify: false,
            translateX: 0,
            translateY: 56,
            itemsSpacing: 0,
            itemWidth: 100,
            itemHeight: 18,
            itemTextColor: "#999",
            itemDirection: "left-to-right",
            symbolSize: 18,
            symbolShape: "circle",
            effects: [
              {
                on: "hover",
                style: {
                  itemTextColor: "#000",
                },
              },
            ],
          },
        ]}
      />
    </div>
  );
};

export default HIndexCitationsPieChart;
