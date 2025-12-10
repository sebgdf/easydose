import { FaSpinner } from 'react-icons/fa';
import React, {Component} from 'react';
function spinner() {
    return (
        <div className="col-md-12">
            <center><FaSpinner icon="spinner" className="spinner" /> Chargement... </center>
         </div>
     );
};
export default spinner;