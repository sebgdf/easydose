import React, {Component, useState, useEffect } from 'react';
import PaginatedItems from '../nav/pagination';
import { createRoot } from 'react-dom/client';
import { useRef } from 'react';
import ReactPaginate from 'react-paginate';
import ProtocolSelector from './ProtocolSelector';

function Filter(){

    const [isEnfantsChecked,setIsEnfantsChecked] = useState(false);
    const [isScannerChecked ,setIsScannerChecked] = useState(false);
    const [isRadioChecked,setIsRadioChecked] = useState(false);
    const [isNrdChecked,setIsNrdChecked] = useState(false);
    const [isMammoChecked,setIsMammoChecked] = useState(false);
    const [isTousChecked,setIsTousChecked] = useState(true);
    const [isPediatrieChecked,setIsPediatrieChecked] = useState(false);
    const [isHommeChecked,setIsHommeChecked] = useState(false);
    const [isFemmeChecked,setIsFemmeChecked] = useState(false);
    const nav = useRef(0);
    const renderTrigger = useRef(0);
    const [itemOffset, setItemOffset] = useState(0);
    const [pageCount, setPageCount] = useState(2);
   
    useEffect(() => {
      rendernav();
    }, [isEnfantsChecked, isScannerChecked, isRadioChecked, isNrdChecked, isMammoChecked,isPediatrieChecked,isHommeChecked,isFemmeChecked]);

    if (!nav.current) {
        const navElement = document.getElementById('nav');
       if (navElement) {
          nav.current = createRoot(navElement);

 
        } else {
          console.error('Element DOM #nav non trouvé');
          return;
        }
      }

    const rendernav = () => {
    renderTrigger.current++;
    if (nav.current) {
        nav.current.render(
            <PaginatedItems  key={renderTrigger.current} 
            itemsperPage={15} 
            istousChecked={isTousChecked} 
            ismammoChecked={isMammoChecked} 
            isscannerChecked={isScannerChecked} 
            isradioChecked={isRadioChecked}
            isnrdChecked={isNrdChecked} 
            isenfantsChecked={isEnfantsChecked}          
            isPediatrieChecked={isPediatrieChecked}
            isHommeChecked={isHommeChecked} 
            isFemmeChecked={isFemmeChecked} 
            
            />
        );
    }
    };


    /*const [renderCount, setRenderCount] = useState(0);

    const rendernav = useCallback((newProps) => {
      if (nav.current) {
        nav.current.render(
          <NavComponent
            {...newProps}
            key={`nav-${renderCount}`} // Clé unique par rendu
          />
        );
        setRenderCount(c => c + 1); // Force le re-rendu
      }
    }, [renderCount]);
    */
    // Utilisation :
    //rendernav({ filters: updatedFilters });

//    const updateNav = () => {
//        if (nav.current) {
//            nav.current.render(
//                <PaginatedItems itemsPerPage={15} isTousChecked={isTousChecked} isMammoChecked={isMammoChecked} isScannerChecked={isScannerChecked} isRadioChecked={isRadioChecked} isNrdChecked={isNrdChecked} isEnfantsChecked={isEnfantsChecked} />
//              );
//        }
//      };

    const manageechebox = (e,name) =>{
        //console.log(name);
        if (name!='handleTousChange'){

            if(e.target.checked)
                {
                    setIsTousChecked(!(isEnfantsChecked || isScannerChecked || isRadioChecked || isNrdChecked || isMammoChecked || isPediatrieChecked || isHommeChecked || isFemmeChecked || e.target.checked));
                    _istousChecked= e.target.checked;
          //          console.log(isTousChecked);
           //         console.log((isEnfantsChecked || isScannerChecked || isRadioChecked || isNrdChecked || isMammoChecked));
          //          console.log(isMammoChecked);
                }else
                {

                   // console.log(!(isEnfantsChecked || isScannerChecked || isRadioChecked || isNrdChecked ||  e.target.checked));
                    if (name=='handleEnfantsChange')
                        {setIsTousChecked(!(isScannerChecked || isRadioChecked || isNrdChecked || isMammoChecked || isPediatrieChecked || isHommeChecked || isFemmeChecked || e.target.checked));_isenfantsChecked= e.target.checked;}
                    if (name=='handleMammoChange')
                        {setIsTousChecked(!(isEnfantsChecked || isScannerChecked || isRadioChecked || isNrdChecked || isPediatrieChecked || isHommeChecked || isFemmeChecked ||  e.target.checked));_ismammoChecked= e.target.checked;}
                    if (name=='handleScannerChange')
                        {setIsTousChecked(!(isEnfantsChecked || isRadioChecked || isNrdChecked || isMammoChecked || isPediatrieChecked || isHommeChecked || isFemmeChecked || e.target.checked));_isscannerChecked= e.target.checked;}
                    if (name=='handleRadioChange')
                        {setIsTousChecked(!(isEnfantsChecked || isScannerChecked ||  isNrdChecked || isMammoChecked || isPediatrieChecked || isHommeChecked || isFemmeChecked || e.target.checked));_isradioChecked= e.target.checked;}
                    if (name=='handleNrdoChange')
                        {setIsTousChecked(!(isEnfantsChecked || isScannerChecked || isRadioChecked || isMammoChecked || isPediatrieChecked || isHommeChecked || isFemmeChecked || e.target.checked));_isnrdChecked= e.target.checked;}
                    if (name=='handlePediatrieChange')
                      {setIsTousChecked(!(isEnfantsChecked || isScannerChecked || isRadioChecked || isMammoChecked || isHommeChecked || isFemmeChecked|| isNrdChecked || e.target.checked));_ispediatrieChecked= e.target.checked;}
                    if (name=='handleHommeChange')
                      {setIsTousChecked(!(isEnfantsChecked || isScannerChecked || isRadioChecked || isMammoChecked || isPediatrieChecked || isFemmeChecked || isNrdChecked ||e.target.checked));_ishommeChecked= e.target.checked;}
                    if (name=='handleFemmeChange')
                      {setIsTousChecked(!(isEnfantsChecked || isScannerChecked || isRadioChecked || isMammoChecked || isPediatrieChecked || isHommeChecked || isNrdChecked ||e.target.checked));_isfemmeChecked= e.target.checked;}



                  }
        }else 
        {
            if(e.target.checked)
                {
                    setIsEnfantsChecked(false);
                    setIsMammoChecked(false);
                    setIsScannerChecked(false);
                    setIsRadioChecked(false);
                    setIsNrdChecked(false);
                    setIsPediatrieChecked(false);
                    setIsHommeChecked(false);
                    setIsFemmeChecked(false);
                }else
                setIsTousChecked(true);

        }
            
    }
    const handleTousChange = (e) => {
        
        setIsTousChecked(e.target.checked);
        manageechebox(e,'handleTousChange');
        rendernav(isEnfantsChecked ,isScannerChecked, isRadioChecked,isNrdChecked ,isMammoChecked, isMammoChecked ,isPediatrieChecked,isHommeChecked,isFemmeChecked);
       // console.log('setIsTousChecked');

      };

        // Invoke when user click to request another page.
  const handlePageClick = (event) => {
    const newOffset = (event.selected * itemsPerPage) % items.length;
    //console.log(
    //  `User requested page number ${event.selected}, which is offset ${newOffset}`
    //);
    setItemOffset(newOffset);
  };

    const handleEnfantsChange = (e) => {
        setIsEnfantsChecked(e.target.checked);
        manageechebox(e,'handleEnfantsChange');
        rendernav(e.target.checked ,isScannerChecked, isRadioChecked,isNrdChecked ,isMammoChecked,isPediatrieChecked,isHommeChecked,isFemmeChecked);
      //  console.log('setIsEnfantsChecked');
      };
      const handleMammoChange = (e) => {
        setIsMammoChecked(e.target.checked);
        manageechebox(e,'handleMammoChange');
      //  console.log('setIsMammoChecked');
        rendernav(isEnfantsChecked ,isScannerChecked, isRadioChecked,isNrdChecked, e.target.checked,isPediatrieChecked,isHommeChecked,isFemmeChecked);
      };
      const handleScannerChange = (e) => {
        setIsScannerChecked(e.target.checked);
        manageechebox(e,'handleScannerChange');
      //  console.log('setIsScannerChecked');
        rendernav(isEnfantsChecked ,e.target.checked, isRadioChecked,isNrdChecked ,isMammoChecked,isPediatrieChecked,isHommeChecked,isFemmeChecked);
      };
      const handleRadioChange = (e) => {
        setIsRadioChecked(e.target.checked);
        manageechebox(e,'handleRadioChange');
      //  console.log('setIsRadioChecked');
        rendernav(isEnfantsChecked ,isScannerChecked, e.target.checked,isNrdChecked,isMammoChecked,isPediatrieChecked,isHommeChecked,isFemmeChecked);
      };
      const handleNrdoChange = (e) => {
        setIsNrdChecked(e.target.checked);
        manageechebox(e,'handleNrdoChange');
      //  console.log('setIsNrdChecked');
        rendernav(isEnfantsChecked ,isScannerChecked, isRadioChecked,e.target.checked ,isMammoChecked,isPediatrieChecked,isHommeChecked,isFemmeChecked);
      };


      const handlePediatrieChange = (e) => {
        setIsPediatrieChecked(e.target.checked);
        manageechebox(e,'handlePediatrieChange');
      //  console.log('setIsNrdChecked');
        rendernav(isEnfantsChecked ,isScannerChecked, isRadioChecked,isNrdChecked,isMammoChecked,e.target.checked ,isHommeChecked,isFemmeChecked);
      };

      const handleHommeChange = (e) => {
        setIsHommeChecked(e.target.checked);
        if(e.target.checked)
          setIsFemmeChecked(!e.target.checked);
        manageechebox(e,'handleHommeChange');
      //  console.log('setIsNrdChecked');
        rendernav(isEnfantsChecked ,isScannerChecked, isRadioChecked,isNrdChecked,isMammoChecked,isPediatrieChecked,e.target.checked ,!e.target.checked);
      };


      const handleFemmeChange = (e) => {
        setIsFemmeChecked(e.target.checked);
        if(e.target.checked)
         setIsHommeChecked(!e.target.checked);
        manageechebox(e,'handleFemmeChange');
      //  console.log('setIsNrdChecked');
        rendernav(isEnfantsChecked ,isScannerChecked, isRadioChecked,isNrdChecked ,isMammoChecked,isPediatrieChecked,!e.target.checked,e.target.checked );
      };

      return (
            <div className='row'>

              <div className='col-md-4'>
                <div className="form-check form-switch">
                <input className="form-check-input" type="checkbox" role="switch" id="tous" checked={isTousChecked} onChange={handleTousChange}/>
                <label className="form-check-label" htmlFor="tous">Tous</label>
                </div>
                <div className="form-check form-switch">
                <input className="form-check-input" type="checkbox" role="switch" id="mamo" checked={isMammoChecked} onChange={handleMammoChange}/>
                <label className="form-check-label" htmlFor="mamo">Mammographie</label>
                </div>
                <div className="form-check form-switch">
                <input className="form-check-input" type="checkbox" role="switch" id="scanner" checked={isScannerChecked} onChange={handleScannerChange}/>
                <label className="form-check-label" htmlFor="scanner">Scanner</label>
                </div>
                <div className="form-check form-switch">
                <input className="form-check-input" type="checkbox" role="switch" id="radio" checked={isRadioChecked} onChange={handleRadioChange}/>
                <label className="form-check-label" htmlFor="radio">Radiographie</label>
                </div>
                <div className="form-check form-switch">
                <input className="form-check-input" type="checkbox" role="switch" id="nrd" checked={isNrdChecked} onChange={handleNrdoChange}/>
                <label className="form-check-label" htmlFor="nrd">Nrd</label>
                </div>
                </div>
                <div className='col-md-4'>
                <div className="form-check form-switch">
                <input className="form-check-input" type="checkbox" role="switch" id="enfants" checked={isPediatrieChecked} onChange={handlePediatrieChange}/>
                <label className="form-check-label" htmlFor="enfants">Pédiatrie</label>
                </div>
                <div className="form-check form-switch">
                  <input className="form-check-input" type="checkbox" role="switch" id="Homme" checked={isHommeChecked} onChange={handleHommeChange}/>
                  <label className="form-check-label" htmlFor="Homme">Homme</label>
                </div>
                <div className="form-check form-switch">
                  <input className="form-check-input" type="checkbox" role="switch" id="Femme" checked={isFemmeChecked} onChange={handleFemmeChange}/>
                  <label className="form-check-label" htmlFor="Femme">Femme</label>
                </div>
              </div>
              <div className='col-md-4'>
              <div className="form-check form-switch" >
                  <ProtocolSelector />
                </div>
              </div>
         </div>
          );
  
}
  
export default Filter;