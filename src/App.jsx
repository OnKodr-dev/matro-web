import { Routes, Route } from "react-router-dom"
import Navbar from "./components/Navbar"
import ProductCatalogPage from "./pages/ProductCatalogPage"
import ProductDetailPage from "./pages/ProductDetailPage"
import AboutPage from "./pages/AboutPage"
import ContactPage from "./pages/ContactPage"

export default function App() {
  return (
    <>
      <Navbar />
      <Routes>
        <Route path="/" element={<ProductCatalogPage />} />
        <Route path="/products" element={<ProductCatalogPage />} />
        <Route path="/product/:slug" element={<ProductDetailPage />} />
        <Route path="/about" element={<AboutPage />} />
        <Route path="/contact" element={<ContactPage />} />
      </Routes>
    </>
  )
}
