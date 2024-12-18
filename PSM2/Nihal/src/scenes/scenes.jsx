import { Routes, Route } from "react-router-dom";
import Dashboard from "./dashboard";
import Bar from "./bar";
import Pie from "./pie";
import Line from "./line";
import Geography from "./geography";
import Publications from "./publications";
import Pie2 from "./pie2";
import Citations from "./citations";
import CitationsBar from "./CitationsBar";
const AppRoutes = () => {
  return (
    <Routes>
      {/* Dashboard */}
      <Route path="/" element={<Dashboard />} />

      {/* Charts */}
      <Route path="/bar" element={<Bar />} />
      <Route path="/pie" element={<Pie />} />
      <Route path="/line" element={<Line />} />
      <Route path="/geography" element={<Geography />} />
      <Route path="/publications" element={<Publications />} />
      <Route path="/pie2" element={<Pie2 />} />
      <Route path="/citationsPie" element={<Citations />} />
      <Route path="/citationsBar" element={<CitationsBar />} />
    </Routes>
  );
};

export default AppRoutes;
