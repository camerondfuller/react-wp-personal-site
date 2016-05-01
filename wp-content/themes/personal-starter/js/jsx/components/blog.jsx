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
   nextPost:function() {
      this.setState({arrayIndex:this.state.arrayIndex + 1});
   },
   render: function() {
      return (
         <div className="triple-column container">
            <div className="single-column">
               <BlogContent object={this.state.postData} arrayIndex={this.state.arrayIndex} />
            </div>
            <a onClick={this.nextPost}>Next Post</a>
         </div>

      );
   }

});

module.exports = BlogLoop;
