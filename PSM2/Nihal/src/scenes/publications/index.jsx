import { Box } from "@mui/material";
import Header from "../../components/Header";
import PublicationBarChart from "../../components/PublicationBarChart";

const Publications = () => {
  return (
    <Box m="20px">
      <Header title="Publication Data" subtitle="Bar Chart for Publications" />
      <Box height="75vh">
        <PublicationBarChart />
      </Box>
    </Box>
  );
};

export default Publications;
