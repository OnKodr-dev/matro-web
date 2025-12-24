export default function Footer(){
    return(
        <footer className="border-t border-gray-200">
            <div className="mx-auto max-w-7x1 px-4 sm:px-66 lg:px-8 py-10 text-sm text-gray-500">
                © {new Date().getFullYear()} Matro.cz
            </div>
        </footer>
    );
}