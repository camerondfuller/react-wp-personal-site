var React = require('react');
var PropTypes = React.PropTypes;
import PageContent from './page-content.jsx';



var About = React.createClass({
   getInitialState: function() {
      return {
         pageObject:[],
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
   render: function() {
      return (
         <div className="about-section">
            <PageContent object={this.state.pageObject}/>
         </div>
      );
   }
});

   module.exports = About;

   //PropTypes
   //mediaID = the json object for the featured image based on the post
