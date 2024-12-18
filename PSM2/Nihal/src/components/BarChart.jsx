import React from "react";
import { ResponsiveBar } from "@nivo/bar";
import scholarData from "../data/scraped_scholar_data.json"; // Adjust the path as necessary

const BarChart = () => {
  // Calculate totals for National Grants and Industry Grants
  const totalNationalGrants = scholarData.reduce(
    (sum, entry) => sum + (entry["NATIONAL GRANTS"] || 0),
    0
  );
  const totalInterNationalGrants = scholarData.reduce(
    (sum, entry) => sum + (entry["INTERNATIONAL GRANTS"] || 0),
    0
  );
  const totalIndustryGrants = scholarData.reduce(
    (sum, entry) => sum + (entry["INDUSTRY GRANTS"] || 0),
    0
  );

  // Prepare data for the bar chart
  const data = [
    { type: "National Grants", count: totalNationalGrants },
    { type: "Industry Grants", count: totalIndustryGrants },
    { type: "International Grants", count: totalInterNationalGrants },
  ];

  return (
    <div style={{ height: "100%", width: "100%", margin: "auto" }}>
      <h2 style={{ textAlign: "center" }}>Grants Overview</h2>
      <ResponsiveBar
        data={data}
        keys={["count"]}
        indexBy="type"
        margin={{ top: 50, right: 50, bottom: 50, left: 60 }}
        padding={0.3}
        colors={{ scheme: "set2" }}
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
          legend: "Grant Type",
          legendPosition: "middle",
          legendOffset: 32,
        }}
        axisLeft={{
          tickSize: 5,
          tickPadding: 5,
          tickRotation: 0,
          legend: "Count",
          legendPosition: "middle",
          legendOffset: -40,
        }}
        labelSkipWidth={12}
        labelSkipHeight={12}
        labelTextColor={{
          from: "color",
          modifiers: [["darker", 1.6]],
        }}
        role="application"
        ariaLabel="Bar chart of grants"
      />
    </div>
  );
};

export default BarChart;
