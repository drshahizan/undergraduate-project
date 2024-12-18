import { Box } from "@mui/material";
import Header from "../../components/Header";
import PieChart from "../../components/PieChart";

const Pie = () => {
  return (
    <Box>
      <Header title="Grants" subtitle="" />
      <Box height="270px" width="100%">
        <PieChart />
      </Box>
    </Box>
  );
};

export default Pie;
