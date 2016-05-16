import React, { PropTypes } from 'react';
import ContactContent from './contact-content.jsx';

class Contact extends React.Component {
   constructor(props) {
      super(props);
      this.state = {
         pageData:[],
         arrayIndex:0
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
         <div className="container">
            <ContactContent object={this.state.pageData} arrayIndex={this.state.arrayIndex} />
         </div>
      );
   }
}

export default Contact;
