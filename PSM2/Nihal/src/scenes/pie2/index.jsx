import { Box } from "@mui/material";
import Header from "../../components/Header";
import PublicationsPieChart from "../../components/PublicationPieChart";

const Pie2 = () => {
  return (
    <Box>
      <Header title="Grants" subtitle="" />
      <Box height="270px" width="100%">
        <PublicationsPieChart />
      </Box>
    </Box>
  );
};

export default Pie2;
