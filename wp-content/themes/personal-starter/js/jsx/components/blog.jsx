import React, { PropTypes } from 'react';
import BlogContent from './blog-content.jsx';

class BlogLoop extends React.Component {
   constructor(props) {
      super(props);
      this.state = {
         postData:[],
         arrayIndex:0
      }
   }
   componentWillMount() {
      this.serverRequest = $.get(this.props.source, function (result) {
         var wpObject = result;
         console.log(wpObject);
         this.setState({
            postData: wpObject,
         });
      }.bind(this));
   }
   componentWillUnmount() {
      this.serverRequest.abort();
   }
   nextPost() {
      var max = this.state.arrayIndex + 1;
      if(max === this.state.postData.length) {
         this.setState({arrayIndex:0})
      } else {
         this.setState({arrayIndex:this.state.arrayIndex + 1});
      }
   }
   prevPost() {
      if(this.state.arrayIndex!==0) {
         this.setState({arrayIndex:this.state.arrayIndex - 1})
      }
   }
   render() {
      return (
         <div className="double-column">
            <div className="single-column">
               <BlogContent object={this.state.postData} arrayIndex={this.state.arrayIndex} />
            </div>
            <div className="blog-buttons">
               <div className="next-class" onClick={this.nextPost}>Next Post <i className="fa fa-angle-double-right"></i></div>
               <div className="prev-class" onClick={this.prevPost}><i className="fa fa-angle-double-left"></i> Previous Post</div>
            </div>
         </div>
      )
   }
}

export default BlogLoop;
