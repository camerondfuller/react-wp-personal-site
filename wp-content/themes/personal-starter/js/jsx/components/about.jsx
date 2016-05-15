import React, { PropTypes } from 'react';
import PageContent from './page-content.jsx';

class About extends React.Component {
   constructor(props) {
      super(props);
      this.state = {
         pageObject:[],
         arrayIndex:this.props.order
      }
   }
   componentWillMount() {
      this.serverRequest = $.get(this.props.source, function (result) {
         var wpObject = result;
         console.log(wpObject);
         this.setState({
            pageObject: wpObject,
         });
      }.bind(this));
   }
   componentWillUnmount() {
      this.serverRequest.abort();
   }
   render () {
      return (
         <div className="container">
            <PageContent object={this.state.pageObject} arrayIndex={this.state.arrayIndex}/>
         </div>
      );
   }
}

export default About;
