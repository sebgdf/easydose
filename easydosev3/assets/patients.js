import React from 'react';
import { createRoot } from 'react-dom/client';
//import AllPatients from './patient/patients';
import Filter from './filter/filter';

//console.log(parameters);
//const param=searchParams.get("limit")
//console.log(param);

const filter = createRoot(document.getElementById('filter'));
//const patients = createRoot(document.getElementById('patients'));

filter.render(
     
       <Filter parameters={parameters}/>
);