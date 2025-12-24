export default function Modal({ open, onClose, children, title }) {
  if (!open) return null

  return (
    <div
      className="fixed inset-0 z-50 flex items-center justify-center p-4"
      onClick={onClose} // klik mimo obsah zavře modal
    >
      {/* Overlay */}
      <div className="absolute inset-0 bg-black/40 backdrop-blur-sm" />

      {/* Obsah modalu */}
      <div
        className="relative w-full max-w-2xl rounded-2xl border border-gray-200 bg-white shadow-xl"
        onClick={(e) => e.stopPropagation()} // zabrání zavření při kliknutí dovnitř
      >
        <div className="flex items-center justify-between p-4 border-b border-gray-200">
          <h4 className="text-lg font-semibold text-gray-900">{title}</h4>
          <button
            onClick={onClose}
            className="rounded-lg px-2 py-1 text-gray-500 hover:text-gray-900"
          >
            ✕
          </button>
        </div>
        <div className="p-4">{children}</div>
      </div>
    </div>
  )
}
