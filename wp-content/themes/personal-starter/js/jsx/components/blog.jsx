var React = require('react');
var PropTypes = React.PropTypes;
import BlogContent from './blog-content.jsx';

var BlogLoop = React.createClass({

   getInitialState: function() {
      return {
         postData:[],
         arrayIndex:0
      };
   },
   componentWillMount: function() {
      this.serverRequest = $.get(this.props.source, function (result) {
         var wpObject = result;
         console.log(wpObject);
         this.setState({
            postData: wpObject,
         });
      }.bind(this));
   },
   componentWillUnmount: function() {
      this.serverRequest.abort();
   },
   nextPost:function() {
      var max = this.state.arrayIndex + 1;
      if(max === this.state.postData.length) {
         this.setState({arrayIndex:0})
      } else {
         this.setState({arrayIndex:this.state.arrayIndex + 1});
      }
   },
   prevPost: function() {
      if(this.state.arrayIndex!==0) {
         this.setState({arrayIndex:this.state.arrayIndex - 1})
      }
   },
   render: function() {
      return (
         <div className="double-column container">
            <div className="single-column">
               <BlogContent object={this.state.postData} arrayIndex={this.state.arrayIndex} />
            </div>
            <div className="blog-buttons">
               <div className="next-class" onClick={this.nextPost}>Next Post <i className="fa fa-angle-double-right"></i></div>
               <div className="prev-class" onClick={this.prevPost}><i className="fa fa-angle-double-left"></i> Previous Post</div>
            </div>
         </div>

      );
   }

});

module.exports = BlogLoop;
