import React, {Component,createContext} from 'react';
import { FaExclamation  } from "react-icons/fa";
import Spinner from '../spinner/spinner'
import $ from 'jquery';
import 'jquery-loading'; 

class Card extends Component {
  constructor() {
    super();
    this.state = { loading: true};
  }

  componentDidMount() {
    this.image = this.choseimage();
    this.title = this.choseTitle();
    this.textcolor=this.choseColor();
    //this.nrd=afficherNrd();
    //=afficherNrd;
    this.setState({ loading: false,image:this.image,title:this.title,patient:this.props.patient})
  }

  choseimage() {
    //console.log(this.props.cardType);
    if(this.props.patient.havemammo)
      return '../images/Mammographie.jpeg';
    if(this.props.patient.haveradio)
      return '../images/Radiographie.jpg';
    if(this.props.patient.havescanner)
      return '../images/scanner.jpeg';
    return '../images/scanner.jpeg';;

  }
  choseTitle() {
    if(this.props.patient.havemammo)
      return 'Mammographie';
    if(this.props.patient.haveradio)
      return 'Radiographie';
    if(this.props.patient.havescanner)
      return 'Scanner';
    return 'Scanner';
  }

  choseColor() {
    if(this.props.patient.sex=="Homme")
      return 'text-blue';
    return 'text-pink' ;
  }

   CalculAge(dateNaissance) { 
    var today = new Date(); 
    var age = today.getFullYear() - dateNaissance.getFullYear();
    var m = today.getMonth() - dateNaissance.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < dateNaissance.getDate())) {
        age = age - 1;
    }
    //console.log(dateNaissance.toString());
  //console.log(age);
    return  age; // que l'on place dans le input d'id Age
}

  spin(){
   // console.log('spin');
    return <div className="row g-0"> Spinner()</div>;

  }

   formatDate(date) {
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0'); // Les mois commencent à 0
    const year = date.getFullYear();
    return `${day}/${month}/${year}`;
  }

  getinfopatient(){

    /*$('#maincontent').loading({
      stoppable: true,
          message: 'Chargement...',
          theme: 'dark'
        });*/
    /*$('#maincontent').loading({
      theme: 'light',
      hideAnimation: function() {
        $(this).remove(); // Force la suppression
      }
    });*/
    //console.log(this);  
    this.urljsonpatients= window.location.protocol + "//" + window.location.host;

    $('#maincontent').load(this.urljsonpatients+'/patient/infopatient/'+this.props.patient.id);
    $('#tabledetailcontent').load(this.urljsonpatients+'/patient/tdpatient/'+this.props.patient.id);
    
    }
afficherNrd(){
  if(this.props.patient.nrdhavealerte=="1")
    return <p className="card-text text-danger">NRD <i class='bi bi-exclamation-triangle'></i></p>
  else
    return <p className="card-text"></p>
}
  loadedcard(){
   // console.log('loadedcard');
      return (
            <div className="row g-0">            
              <div className="col-md-5">
              <div className="row">
                    <div className="col-md-12 text-uppercase"><h4><center>{this.state.title}</center></h4></div>
                </div>
                <div className="row">
                    <div className="col-md-12"><img src={this.state.image} className="img-fluid rounded-start" alt="..."/></div>
                    <div className="col-md-12">
                      
                        <div className="row">
                            <div className="col-md-12">
                            <center><p className="card-text">Nombre d'expositions</p></center>
                            </div>
                            <div className="col-md-12">
                            <center><h1><p className="card-text"><strong  className={(this.state.patient.sumhavealerte=="1")?"text-danger":""}>{this.state.patient.nbdoses}</strong></p></h1></center>
                            </div>
                          </div>
                    
                    </div>
                      <div className="col-md-12">
                      <center><h4><strong>{(this.props.patient.nrdhavealerte=="1")?<p className="card-text text-danger">NRD<FaExclamation className="mt-n1 mr-1" /></p>:<p className="card-text"></p>}
                        </strong></h4></center>
                      </div>
                </div>
              </div>
              <div className="col-md-7">
                <div className="card-body">
                  <h5 className= {"card-title text-end " + this.textcolor}>{(this.state.patient.sex=="Homme")?"Monsieur ":"Madame "}{this.state.patient.nom} {this.state.patient.prenom}</h5>
                  
                  <div className="row">
                    <div className="col-md-12">
                      <ul className="list-group list-group-flush">
                        <li className="list-group-item pb-1 pt-1">N° dossier : <strong className={ this.textcolor}>{this.state.patient.numipp}</strong></li>
                        <li className="list-group-item pb-1 pt-1">Né le <strong className={ this.textcolor}>{this.state.patient.datedenaissancestring} </strong></li>
                        <li className="list-group-item pb-1 pt-1">Date dernier examen : <strong className={ this.textcolor}>{ (this.state.patient.datelastexam !=null)?this.formatDate(new Date(this.state.patient.datelastexam.timestamp * 1000 )): 'Inconnu' } </strong></li>
                        <li className="list-group-item pb-5">Age :  <strong className={ this.textcolor}>{this.CalculAge(new Date(this.state.patient.datenaissance.timestamp * 1000 ))} ans </strong></li>


                      </ul>

                    </div>


                    </div>

                    <div className="row">
                      <div className="col-md-12">
                      <center><button key={this.state.patient.id} type="button" onClick={() =>this.getinfopatient()} className="btn btn-secondary btn-lg btn-block">Informations patient</button></center>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          );
  }
  createcard(){
    return this.state.loading? this.spin():this.loadedcard();
  }
    render() {
      return (
              <div className="card mb-3" >
              {
                this.createcard()
              }
              </div>
              );
    }
  }
  
export default Card;