import { Box } from "@mui/material";
import Header from "../../components/Header";
import HIndexCitationsBarChart from "../../components/CitationBar";

const CitationsBar = () => {
  return (
    <Box m="20px">
      <Header title="Bar Chart" subtitle="Simple Bar Chart" />
      <Box height="75vh">
        <HIndexCitationsBarChart />
      </Box>
    </Box>
  );
};

export default CitationsBar;
