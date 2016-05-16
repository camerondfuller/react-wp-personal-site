import React, { PropTypes } from 'react';

class ContactContent extends React.Component {
   constructor(props) {
      super(props);
      this.state = {
         pageTitle:'',
         pageContent:''
      }
   }
   componentWillReceiveProps(nextProps) {
      this.setState({
        pageTitle: nextProps.object[nextProps.arrayIndex].title.rendered,
        pageContent:nextProps.object[nextProps.arrayIndex].content.rendered,
      });
   }
   render () {
      return (
         <div className="double-column container">
            <div className="single-column" dangerouslySetInnerHTML={{__html: this.state.pageContent}}></div>
         </div>
      )
   }
}

export default ContactContent;
