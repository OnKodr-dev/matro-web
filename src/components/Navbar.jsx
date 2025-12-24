import { Link } from "react-router-dom"

export default function Navbar() {
  return (
    <header className="sticky top-0 z-40 bg-emerald-200 backdrop-blur">
      <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
        {/* Logo */}
        <Link to="/" className="flex items-center gap-2">
          <div className="h-8 w-8 rounded-lg bg-emerald-500" />
          <span className="font-bold text-lg text-gray-900">Matro</span>
        </Link>

        {/* Navigace */}
        <nav className="flex items-center gap-6 text-sm font-medium">
          <Link to="/about" className="text-gray-700 hover:text-gray-900">O společnosti</Link>
          <Link to="/products" className="text-gray-700 hover:text-gray-900">Produkty</Link>
          <Link to="/contact" className="text-gray-700 hover:text-gray-900">Kontakt</Link>
        </nav>
      </div>
    </header>
  )
}
