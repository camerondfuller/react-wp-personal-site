var React = require('react');
var PropTypes = React.PropTypes;
import ContactContent from './contact-content.jsx';

var Contact = React.createClass({
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
         <div className="container">
            <ContactContent object={this.state.pageData} arrayIndex={this.state.arrayIndex} />
         </div>
      );
   }

});

module.exports = Contact;
