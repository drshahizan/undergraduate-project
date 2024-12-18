import { ResponsiveBar } from "@nivo/bar";
import scholarData from "../data/scholarData.json";
const GrantTypesStackedBarChart = ({ scholarData }) => {
  const data = scholarData.map((scholar, index) => ({
    id: `Scholar ${index + 1}`,
    industry: scholar["INDUSTRY GRANTS"] || 0,
    international: scholar["INTERNATIONAL GRANTS"] || 0,
    national: scholar["NATIONAL GRANTS"] || 0,
    university: scholar["UNIVERSITY FUND"] || 0,
  }));

  return (
    <div style={{ height: "400px" }}>
      <ResponsiveBar
        data={data}
        keys={["industry", "international", "national", "university"]}
        indexBy="id"
        margin={{ top: 40, right: 80, bottom: 80, left: 80 }}
        padding={0.3}
        colors={{ scheme: "pastel2" }}
        axisBottom={{
          legend: "Scholars",
          legendPosition: "middle",
          legendOffset: 32,
        }}
        axisLeft={{
          legend: "Grant Count",
          legendPosition: "middle",
          legendOffset: -40,
        }}
        tooltip={({ id, value }) => (
          <div style={{ padding: "5px", color: "white", background: "#333" }}>
            {id}: {value}
          </div>
        )}
      />
    </div>
  );
};

export default GrantTypesStackedBarChart;
