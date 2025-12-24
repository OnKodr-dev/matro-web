// src/pages/ContactPage.jsx
export default function ContactPage() {
    return (
      <div className="bg-white text-black">
        <div className="mx-auto max-w-3xl px-4 py-16">
          <h1 className="text-3xl font-extrabold text-black mb-6 pb-2">
            Kontakt
          </h1>
  
          <div className="space-y-5 text-lg leading-relaxed">
            <p className="font-semibold">MATRO Praha, s.r.o.</p>
            <p>
              Neklanova 107/22 <br />
              128 00 Praha 2 – Vyšehrad
            </p>
  
            <p>
              <span className="font-medium">IČO:</span> 27564541 <br />
              <span className="font-medium">DIČ:</span> CZ27564541
            </p>
  
            <div>
              <p className="font-medium">Tel./Fax:</p>
              <p className="ml-4">
                +420 224 917 428 <br />
                +420 267 911 082
              </p>
            </div>
  
            <p>
              <span className="font-medium">E-mail:</span>{" "}
              <a href="mailto:matro@matro.cz" className="text-black">
                matro@matro.cz
              </a>
              <br />
              <span className="font-medium">Web:</span>{" "}
              <a href="http://www.matro.cz" target="_blank" rel="noreferrer" className="text-black">
                www.matro.cz
              </a>
            </p>
          </div>
  
          <div className="mt-10 p-6 bg-white rounded-2xl">
            <h2 className="text-xl font-bold text-black mb-3">Jak nás najdete</h2>
            <p>
              Sídlo společnosti se nachází v Praze na Vyšehradě. V případě zájmu o osobní schůzku nás prosím
              kontaktujte předem telefonicky nebo e-mailem.
            </p>
          </div>
        </div>
      </div>
    )
  }
  