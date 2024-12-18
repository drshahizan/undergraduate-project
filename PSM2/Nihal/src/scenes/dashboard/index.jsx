import { Box, Button, IconButton, Typography, useTheme } from "@mui/material";
import { tokens } from "../../theme";
import { mockTransactions } from "../../data/mockData";
import DownloadOutlinedIcon from "@mui/icons-material/DownloadOutlined";
import EmailIcon from "@mui/icons-material/Email";
import PointOfSaleIcon from "@mui/icons-material/PointOfSale";
import PersonAddIcon from "@mui/icons-material/PersonAdd";
import TrafficIcon from "@mui/icons-material/Traffic";
import Header from "../../components/Header";
import LineChart from "../../components/LineChart";
import GeographyChart from "../../components/GeographyChart";
import BarChart from "../../components/BarChart";
import StatBox from "../../components/StatBox";
import ProgressCircle from "../../components/ProgressCircle";
import Pie from "../pie";
import Publications from "../publications";
import scholarData from "../../data/scraped_scholar_data.json";
import trainingData from "../../data/training.json";
import Pie2 from "../pie2";
const Dashboard = () => {
  const theme = useTheme();
  const colors = tokens(theme.palette.mode);
  // Summing up H-Index, Citations, and Publications
  const totalHIndex = scholarData.reduce(
    (sum, scholar) => sum + scholar["H-INDEXED (SCOPUS)"],
    0
  );
  const totalCitations = scholarData.reduce(
    (sum, scholar) => sum + scholar["CITATIONS (SCOPUS)"],
    0
  );
  const totalPublications = scholarData.reduce(
    (sum, scholar) => sum + scholar["PUBLICATIONS"],
    0
  );
  const totalGrants = scholarData.reduce(
    (sum, scholar) => sum + scholar["GRANT(PI & MEMBERS)"],
    0
  );
  const totalIPublications = scholarData.reduce(
    (sum, scholar) => sum + scholar["INDEXED PUBLICATION"],
    0
  );
  const sumProjectsByYear = (data) => {
    return data.reduce((acc, item) => {
      const year = item.Year;
      acc[year] = (acc[year] || 0) + 1;
      return acc;
    }, {});
  };
  const totalProjectsByYear = sumProjectsByYear(trainingData);
  return (
    <Box m="20px">
      {/* HEADER */}
      <Box display="flex" justifyContent="space-between" alignItems="center">
        <Header title="DASHBOARD" subtitle="Welcome to your dashboard" />
      </Box>

      {/* GRID & CHARTS */}
      <Box
        display="grid"
        gridTemplateColumns="repeat(12, 1fr)"
        gridAutoRows="140px"
        gap="20px"
      >
        {/* ROW 1 */}
        <Box
          gridColumn="span 3"
          backgroundColor={colors.primary[400]}
          display="flex"
          alignItems="center"
          justifyContent="center"
        >
          <StatBox
            title={totalIPublications.toLocaleString()}
            subtitle={
              <Typography
                sx={{
                  color: colors.greenAccent[300], // Change subtitle color here
                  fontSize: "16px",
                  fontWeight: "bold",
                  marginTop: "5px",
                }}
              >
                Indexed Publications
              </Typography>
            }
            progress=".542"
            increase={
              <Typography
                sx={{
                  color: colors.greenAccent[100], // Change subtitle color here
                  fontSize: "16px",
                  fontWeight: "bold",
                }}
              >
                54.2%
              </Typography>
            }
            icon={
              <Typography
                variant="caption"
                sx={{
                  color: colors.blueAccent[600],
                  fontSize: "18px",
                  fontWeight: "bold",
                  marginBottom: "5px",
                }}
              >
                Faculty of Computing
              </Typography>
            }
          />
        </Box>
        <Box
          gridColumn="span 3"
          backgroundColor={colors.primary[400]}
          display="flex"
          alignItems="center"
          justifyContent="center"
        >
          <StatBox
            title={totalPublications.toLocaleString()}
            subtitle={
              <Typography
                sx={{
                  color: colors.greenAccent[300], // Change subtitle color here
                  fontSize: "16px",
                  fontWeight: "bold",
                  marginTop: "5px",
                }}
              >
                Publications
              </Typography>
            }
            progress="0.75"
            increase="+14%"
            icon={
              <Typography
                variant="caption"
                sx={{
                  color: colors.redAccent[600],
                  fontSize: "18px",
                  fontWeight: "bold",
                  marginBottom: "5px",
                }}
              >
                Faculty of Computing
              </Typography>
            }
          />
        </Box>
        <Box
          gridColumn="span 3"
          backgroundColor={colors.primary[400]}
          display="flex"
          alignItems="center"
          justifyContent="center"
        >
          <StatBox
            title={totalCitations.toLocaleString()}
            subtitle={
              <Typography
                sx={{
                  color: colors.greenAccent[300], // Change subtitle color here
                  fontSize: "16px",
                  fontWeight: "bold",
                  marginTop: "5px",
                }}
              >
                Citations
              </Typography>
            }
            progress="0.50"
            increase="+21%"
            icon={
              <Typography
                variant="caption"
                sx={{
                  color: colors.blueAccent[200],
                  fontSize: "18px",
                  fontWeight: "bold",
                  marginBottom: "5px",
                }}
              >
                Faculty of Computing
              </Typography>
            }
          />
        </Box>
        <Box
          gridColumn="span 3"
          backgroundColor={colors.primary[400]}
          display="flex"
          alignItems="center"
          justifyContent="center"
        >
          <StatBox
            title={totalHIndex.toLocaleString()}
            subtitle={
              <Typography
                sx={{
                  color: colors.greenAccent[300], // Change subtitle color here
                  fontSize: "16px",
                  fontWeight: "bold",
                  marginTop: "5px",
                }}
              >
                H-Index
              </Typography>
            }
            progress="0.30"
            increase="+5%"
            icon={
              <Typography
                variant="caption"
                sx={{
                  color: colors.blueAccent[400],
                  fontSize: "18px",
                  fontWeight: "bold",
                  marginBottom: "5px",
                }}
              >
                Faculty of Computing
              </Typography>
            }
          />
        </Box>
        <Box
          gridColumn="span 3"
          backgroundColor={colors.primary[400]}
          display="flex"
          alignItems="center"
          justifyContent="center"
        >
          <StatBox
            title={totalGrants.toLocaleString()}
            subtitle="Grants(Pi & Members)"
            progress=""
            increase="+5%"
            icon={
              <Typography
                variant="caption"
                sx={{
                  color: colors.blueAccent[400],
                  fontSize: "18px",
                  fontWeight: "bold",
                  marginBottom: "5px",
                }}
              >
                Faculty of Computing
              </Typography>
            }
          />
        </Box>
        <Box
          gridColumn="span 3"
          backgroundColor={colors.primary[400]}
          display="flex"
          alignItems="center"
          justifyContent="center"
        >
          <StatBox
            title={totalProjectsByYear[2024] || 0}
            subtitle="Trainings Conducted (2024)"
            icon={
              <Typography
                variant="caption"
                sx={{
                  color: colors.blueAccent[400],
                  fontSize: "18px",
                  fontWeight: "bold",
                  marginBottom: "5px",
                }}
              >
                Faculty of Computing
              </Typography>
            }
          />
        </Box>
        <Box
          gridColumn="span 3"
          backgroundColor={colors.primary[400]}
          display="flex"
          alignItems="center"
          justifyContent="center"
        >
          <StatBox
            title={totalProjectsByYear[2023] || 0}
            subtitle="Trainings Conducted (2023)"
            icon={
              <Typography
                variant="caption"
                sx={{
                  color: colors.blueAccent[600],
                  fontSize: "14px",
                  fontWeight: "bold",
                }}
              >
                Yearly Data
              </Typography>
            }
          />
        </Box>

        {/* ROW 2 */}
        {/* <Box
          gridColumn="span 8"
          gridRow="span 2"
          backgroundColor={colors.primary[400]}
        >
          <Box
            mt="25px"
            p="0 30px"
            display="flex "
            justifyContent="space-between"
            alignItems="center"
          >
            <Box>
              <Typography
                variant="h5"
                fontWeight="600"
                color={colors.grey[100]}
              >
                Revenue Generated
              </Typography>
              <Typography
                variant="h3"
                fontWeight="bold"
                color={colors.greenAccent[500]}
              >
                $59,342.32
              </Typography>
            </Box>
            <Box>
              <IconButton>
                <DownloadOutlinedIcon
                  sx={{ fontSize: "26px", color: colors.greenAccent[500] }}
                />
              </IconButton>
            </Box>
          </Box>
          <Box height="250px" m="-20px 0 0 0">
            <LineChart isDashboard={true} />
          </Box>
        </Box> */}

        {/* ROW 3 */}
        <Box
          gridColumn="span 4"
          gridRow="span 3"
          backgroundColor={colors.primary[400]}
          p="30px"
        >
          <Typography variant="h5" fontWeight="600">
            Faculty of Computing
          </Typography>
          <Box height="300px" width="100%">
            <Pie />
            <Typography
              variant="h5"
              color={colors.greenAccent[500]}
              sx={{ mt: "15px" }}
            >
              Total:374
            </Typography>
            <Typography>
              Includes National(Industrial) & International Grants
            </Typography>
          </Box>
        </Box>
        <Box
          gridColumn="span 7"
          gridRow="span 3"
          backgroundColor={colors.primary[400]}
          p="5px"
        >
          <Typography variant="h5" fontWeight="600">
            Faculty of Computing
          </Typography>
          <Box height="300px" width="100%">
            <Pie2 />
            <Typography
              variant="h5"
              color={colors.greenAccent[500]}
              sx={{ mt: "15px" }}
            >
              Total:374
            </Typography>
            <Typography>
              Includes National(Industrial) & International Grants
            </Typography>
          </Box>
        </Box>
        <Box
          gridColumn="span 4"
          gridRow="span 2"
          backgroundColor={colors.primary[400]}
        >
          <Typography
            variant="h5"
            fontWeight="600"
            sx={{ padding: "30px 30px 0 30px" }}
          >
            Sales Quantity
          </Typography>
          <Box height="250px" mt="-20px">
            <BarChart isDashboard={true} />
          </Box>
        </Box>
      </Box>
    </Box>
  );
};

export default Dashboard;
