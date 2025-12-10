import React, {Component,useState} from 'react';
import Card from '../card/card';
import Spinner from '../spinner/spinner'
import { createRoot } from 'react-dom/client';
import { useRef } from 'react';
//const spinRef = useRef(null);
//const [current, setCurrent] = useState(this);
var current=null;
import ReactPaginate from 'react-paginate';


const getelements = (pos)=>{
 // console.log('element at : '+pos+' auther lement==>'+current.limit);
  current.load();
  }

 const handlePageClick = (event)=>{
  current.offset=event.selected * current.limit;//) % current.totalNotFiltered;
  //currentpage=event.selected;
    //console.log(event);
    //current.setoffset(offset);
    getelements(event.selected);
   // console.log(
   //   `User requested page number ${event.selected}, which is offset ${current.offset}, ${current.limit}, ${current.totalNotFiltered}`
   // );
    //console.log('event======>');
    //console.log(event);
    
  };

  const handleOnClick =(event)=>{
    //console.log("---------------------handleOnClick---------------------");

    current.currentpage= event.nextSelectedPage;
    ///if(event.isPrevious)
    //  event.nextSelectedPage=current.currentpage-1
    //if(event.isNext)
    //  event.nextSelectedPage=current.currentpage+1
    //console.log(current);
    //console.log(event);
  }
class PaginatedItems extends Component {
  constructor() {
    super();
    this.pageCount=1;
    this.totalNotFiltered=0;
    this.total=0;
    this.offset=0;
    this.nextSelectedPage=1;
    this.currentpage=0;
    this.state = { loading: true,itemsperPage:this.itemsperPage};
    //console.log(this.state );
    this.spinRef = React.createRef();
    this.patients =null;
    
    //const [current, setCurrent] = useState(this);
  }
  setoffset(offset){
    this.offset=offset;
    this.setState({ loading: false});
  }
  componentDidMount() {
   current=this;
   this.limit=this.props.itemsperPage;
   //his.offset=1;
   this.setparameter()
   //if (!nav.current) {
   const spinElement = document.getElementById('patients');
   if (spinElement) {
    this.patients= createRoot(spinElement);
     //this.renderSpin();
   //}
   }

   this.load();
   
}


calcNbItems() {
  //console.log(this.props.itemsperPage);
  // Simulate fetching items from another resources.
  // (This could be items from props; or items loaded in a local state
  // from an API endpoint with useEffect and useState)
  this.endOffset = this.offset + this.limit;
  //console.log(`Loading items from ${this.offset } to ${this.endOffset}`);
  //const currentItems = items.slice(itemOffset, endOffset);
  this.pageCount = Math.ceil(this.totalNotFiltered / this.limit);

}

setparameter(){
  this.filter="";
  
  
  if(this.props.istousChecked)
    this.filter="";
  if(this.props.ismammoChecked)
   this.filter=this.filter+"&havemammo=1";
  if(this.props.isscannerChecked)
    this.filter=this.filter+"&havescanner=1";
  if(this.props.isradioChecked)
    this.filter=this.filter+"&haveradio=1";
  if(this.props.isnrdChecked)
    this.filter=this.filter+"&nrdhavealerte=1";
  if(this.props.isPediatrieChecked)
    this.filter=this.filter+"&ispediatrie=1";
  if(this.props.isHommeChecked)
    this.filter=this.filter+"&ishomme=1";
  if(this.props.isFemmeChecked)
    this.filter=this.filter+"&isfemme=1";
  //console.log('this.filter: '+this.filter);
}


renderpatients(rows){
  this.rows=rows;
  //const patients = createRoot(document.getElementById('patients')); 
  //console.log(this.pageCount);
  this.patients.render(

    
    <div className="row">
        <div className='col-md-12 pagination justify-content-end'>
          <ReactPaginate
            breakLabel="..."
            forcePage={this.currentpage}
            nextLabel="next >"
            onPageChange={handlePageClick}
            onClick={handleOnClick}
            pageRangeDisplayed={3}
            pageCount={this.pageCount}
            previousLabel="< previous"
            renderOnZeroPageCount={null}
            key={`${this.offset}`}
            disableInitialCallback={true}
            pageClassName="page-item"
            pageLinkClassName="page-link"
            previousClassName="page-item"
            previousLinkClassName="page-link"
            nextClassName="page-item"
            nextLinkClassName="page-link"
            breakClassName="page-item"
            breakLinkClassName="page-link"
            containerClassName="pagination"
            activeClassName="active"
          />
        </div>
        {
          this.loadpatients()
        }
    </div>
    );
}


renderspin(){
  if (this.patients) 
  {this.patients.render(
    <div className="row">
    {
       this.spin()
     }
    </div>
    );
  }
}


load(){
   this.setparameter();
   this.urljsonpatients= window.location.protocol + "//" + window.location.host +"/"+jsonpatientspathname;
   this.urljsonpatients= this.urljsonpatients+'?limit='+this.limit+'&offset='+(this.offset)+this.filter;
   //console.log(this.urljsonpatients);
   this.renderspin();
   fetch(this.urljsonpatients)
   .then(response =>response.json())
   .then (result =>this.traiterretourpatiens(result))
}

traiterretourpatiens(result){
   //console.log(result);

   this.setState({ loading: false,listepatients:result.rows});
   //console.log(result);
   this.totalNotFiltered=result.totalNotFiltered;
   this.total=result.total;
   //console.log(this.state.listepatients);
   this.calcNbItems();
   this.renderpatients(result.rows);
}

spin(){
   //console.log('spinpatients');
   return Spinner();
 }
//loadnav(){
//   return <div className="col-md-12" id='navigation'>Navigation</div>
//}

lstpatients(){
      const listpatients=this.rows.map( patient =>{
        return  <div key={`dv-${patient.id}`}  className="col-md-4">
          <Card key={patient.id ?? `patient-${index}`} patient={patient}/>          
        </div>
    })
return listpatients;
}


 loadpatients(){
   //console.log('loadpatients');
   //console.log(this.rows);


   //console.log(listpatients);
   return (
     <div className="col-md-12">
        <div className="row">
          <div className="col-md-12">
            <div className="row" id='listepatients'>
                {this.lstpatients()}
            </div>
          </div>
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

               </div>

            )
   }
}
export default PaginatedItems;