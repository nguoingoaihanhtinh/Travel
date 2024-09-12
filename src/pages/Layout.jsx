import React from "react";
import Navbar from "../components/Navbar/Navbar";
import { Outlet, Link } from "react-router-dom";
import Footer from "../components/Footer/Footer";
import OrderPopup from "../components/OrderPopup/OrderPopup";

const Layout = () => {
 
  return (
    <>
      <Navbar />
      <Outlet />
      <Footer />
    
    </>
  );
};

export default Layout;
