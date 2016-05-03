var React = require('react');
var PropTypes = React.PropTypes;
import PortfolioContent from './portfolio-content.jsx'

var Portfolio = React.createClass({
   getInitialState: function() {
      return {
         pageData:[],
      };
   },
   componentWillMount: function() {
      this.serverRequest = $.get(this.props.source, function (result) {
         var wpObject = result;
         console.log(wpObject);
         this.setState({
            pageData: wpObject,
         });
      }.bind(this));
   },
   componentWillUnmount: function() {
      this.serverRequest.abort();
   },
   render: function() {
      return (
         <div>
            <div className="left-side-name"><span>Portfolio</span></div>
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

});

module.exports = Portfolio;
