import React, { PropTypes } from 'react';
import PortfolioContent from './portfolio-content.jsx';


class Portfolio extends React.Component {
   constructor(props) {
      super(props);
      this.state = {
         pageData:[],
      }
   }
   componentWillMount() {
      this.serverRequest = $.get(this.props.source, function (result) {
         var wpObject = result;
         console.log(wpObject);
         this.setState({
            pageData: wpObject,
         });
      }.bind(this));
   }
   componentWillUnmount() {
      this.serverRequest.abort();
   }
   render () {
      return (
         <div>
            <div className="portfolio-inner container">
               <PortfolioContent object={this.state.pageData} arrayIndex={0}/>
               <PortfolioContent object={this.state.pageData} arrayIndex={1}/>
               <PortfolioContent object={this.state.pageData} arrayIndex={2}/>
               <PortfolioContent object={this.state.pageData} arrayIndex={3}/>
               <PortfolioContent object={this.state.pageData} arrayIndex={4}/>
               <PortfolioContent object={this.state.pageData} arrayIndex={5}/>
            </div>
         </div>
      );
   }
}

export default Portfolio;
