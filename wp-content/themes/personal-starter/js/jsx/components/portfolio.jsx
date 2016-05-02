var React = require('react');
var PropTypes = React.PropTypes;
import PortfolioContent from './portfolio-content.jsx'

var Portfolio = React.createClass({
   getInitialState: function() {
      return {
         pageData:[],
         arrayIndex:0
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
            <div className="buttons container">
               <PortfolioContent object={this.state.pageData} arrayIndex={this.state.arrayIndex} className="triple"/>
            </div>
         </div>
      );
   }

});

module.exports = Portfolio;
