import { Box } from "@mui/material";
import Header from "../../components/Header";
import HIndexCitationsPieChart from "../../components/PieLikeChart";

const Citations = () => {
  return (
    <Box>
      <Header title="Grants" subtitle="" />
      <Box height="270px" width="100%">
        <HIndexCitationsPieChart />
      </Box>
    </Box>
  );
};

export default Citations;
