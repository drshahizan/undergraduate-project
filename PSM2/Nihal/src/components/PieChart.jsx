import { ResponsivePie } from "@nivo/pie";
import { tokens } from "../theme";
import { useTheme } from "@mui/material";
import scholarData from "../data/scraped_scholar_data.json";

const PieChart = () => {
  const theme = useTheme();
  const colors = tokens(theme.palette.mode);

  // Prepare the data for the pie chart
  const data = [
    {
      id: "National Grants",
      value: scholarData.reduce(
        (sum, item) => sum + (item["NATIONAL GRANTS"] || 0),
        0
      ),
    },
    {
      id: "Industry Grants",
      value: scholarData.reduce(
        (sum, item) => sum + (item["INDUSTRY GRANTS"] || 0),
        0
      ),
    },
    {
      id: "International Grants",
      value: scholarData.reduce(
        (sum, item) => sum + (item["INTERNATIONAL GRANTS"] || 0),
        0
      ),
    },
  ];

  // Calculate the total for percentage calculation
  const total = data.reduce((sum, entry) => sum + entry.value, 0);

  // Add percentage labels
  const dataWithPercentage = data.map((item) => ({
    ...item,
    label: `${((item.value / total) * 100).toFixed(1)}%`, // Calculate and format the percentage
  }));

  return (
    <ResponsivePie
      data={dataWithPercentage}
      theme={{
        axis: {
          domain: {
            line: {
              stroke: colors.grey[100],
            },
          },
          legend: {
            text: {
              fill: colors.grey[100],
            },
          },
          ticks: {
            line: {
              stroke: colors.grey[100],
              strokeWidth: 1,
            },
            text: {
              fill: colors.grey[100],
            },
          },
        },
        legends: {
          text: {
            fill: colors.grey[100],
          },
        },
      }}
      margin={{ top: 40, right: 80, bottom: 80, left: 80 }}
      innerRadius={0.5}
      padAngle={0.7}
      cornerRadius={3}
      activeOuterRadiusOffset={8}
      borderColor={{
        from: "color",
        modifiers: [["darker", 0.2]],
      }}
      arcLinkLabelsSkipAngle={10}
      arcLinkLabelsTextColor={colors.grey[100]}
      arcLinkLabelsThickness={2}
      arcLinkLabelsColor={{ from: "color" }}
      enableArcLabels={true} // Enable arc labels
      arcLabelsRadiusOffset={0.6} // Adjust position of labels
      arcLabelsSkipAngle={10} // Minimum angle to display labels
      arcLabelsTextColor={{
        from: "color",
        modifiers: [["darker", 2]],
      }}
      defs={[
        {
          id: "dots",
          type: "patternDots",
          background: "inherit",
          color: "rgba(255, 255, 255, 0.3)",
          size: 4,
          padding: 1,
          stagger: true,
        },
        {
          id: "lines",
          type: "patternLines",
          background: "inherit",
          color: "rgba(255, 255, 255, 0.9)",
          rotation: -45,
          lineWidth: 6,
          spacing: 10,
        },
      ]}
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
          itemOpacity: 1,
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
  );
};

export default PieChart;
