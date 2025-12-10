import React, {Component} from 'react';
import Card from '../card/card';
import Spinner from '../spinner/spinner'



class Patients extends Component {
  constructor() {
    super();
    this.state = { loading: true};
  }

  componentDidMount() {
   this.limit=5;
   this.offset=1;
   this.load(this.limit,this.offset);
   
}

load(limit,offset){
   this.urljsonpatients= window.location.protocol + "//" + jsonlocationhost+"/"+jsonpatientspathname+"?"+this.props.parameters;
   this.urljsonpatients= this.urljsonpatients+'&limit='+limit+'&offset='+offset;
   console.log(this.urljsonpatients);
   fetch(this.urljsonpatients)
   .then(response =>response.json())
   .then (result =>this.traiterretourpatiens(result))
}
traiterretourpatiens(result){
   //console.log(result);
   this.setState({ loading: false,listepatients:result.rows});
}

spin(){
   console.log('spinpatients');
   return Spinner();
 }
loadnav(){
   return <div className="col-md-12" id='navigation'>Navigation</div>
}
 loadpatients(){
   console.log('loadpatients');
   //console.log(this.state.listepatients);

   const listpatients=this.state.listepatients.map( patient =>{
         return <div className="col-md-4">
            <Card patient={patient}/>
         </div>
   })
   //console.log(listpatients);
   return (
      <div className="col-md-12">
         <div className="row">
         {this.loadnav()}
         </div>
         <div className="row" id='listepatients'>
            {listpatients}
         </div>
      </div>
   );

 }

 createPatients(){
   return this.state.loading? this.spin():this.loadpatients();
 }

  render() {
            return (
               <div className="row">
               {
                  this.createPatients()
                }
               </div>

            )
   }
}
export default Patients;