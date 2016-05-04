var React = require('react');
var PropTypes = React.PropTypes;
import PageContent from './page-content.jsx';



var About = React.createClass({
   getInitialState: function() {
      return {
         pageObject:[],
         arrayIndex:this.props.order
      };
   },
   componentWillMount: function() {
      this.serverRequest = $.get(this.props.source, function (result) {
         var wpObject = result;
         console.log(wpObject);
         this.setState({
            pageObject: wpObject,
         });
      }.bind(this));
   },
   componentWillUnmount: function() {
      this.serverRequest.abort();
   },
   render: function() {
      return (
         <div className="container">
            <PageContent object={this.state.pageObject} arrayIndex={this.state.arrayIndex}/>
         </div>
      );
   }
});

module.exports = About;

//PropTypes
//mediaID = the json object for the featured image based on the post
