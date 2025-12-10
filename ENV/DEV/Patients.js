// ./assets/js/components/Patients.js
    
import React, {Component} from 'react';
import axios from 'axios';
import BlockListpatient from './BlockListpatient';
class Patients extends Component {
    constructor() {
        super();
        this.state = { patients: [], loading: true};
    }
    
    componentDidMount() {
        this.getPatients("/api/patients?page=1");
    }
    
    getPatients(page) {
        axios.get(`http://localhost`+page).then(patients => {
           this.setState({ patients: patients.data, loading: false})
       })
    }
    
    render() {
        const loading = this.state.loading;
        return(
                <BlockListpatient objectpatient={this} loading={loading}/>
        )
    }
}
export default Patients;