import { Routes, Route } from "react-router-dom";
import Layout from "./components/Layout";
import ProductCatalogPage from "./pages/ProductCatalogPage";
import ProductDetailPage from "./pages/ProductDetailPage";
import AboutPage from "./pages/AboutPage";
import ContactPage from "./pages/ContactPage";

export default function App() {
  return (
    <>
      <Routes>
        <Route path="/" element={<Layout />}>
        <Route index element={<ProductCatalogPage />} />
        <Route path="/products" element={<ProductCatalogPage />} />
        <Route path="/product/:slug" element={<ProductDetailPage />} />
        <Route path="/about" element={<AboutPage />} />
        <Route path="/contact" element={<ContactPage />} />
        </Route>
      </Routes>
    </>
  )
}
