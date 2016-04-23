var React = require('react');
var PropTypes = React.PropTypes;
import {browserHistory} from 'react-router';


var BlogLoop = React.createClass({

   getInitialState: function() {
      return {
         postData:[],
         postContent:'',
         postTitle:'',
         arrayIndex:0,
         activate: false
      };
   },

   componentDidMount: function() {
      $.ajax({
         datatype:'json',
         method:'GET',
         url:'/wp-json/wp/v2/posts',
         success: function(wpData) {
            this.setState({postData:wpData});
         }.bind(this)
      });
   },
   loadBlog:function() {
      this.setState({activate:true});
      if(this.state.arrayIndex === this.state.postData.length){
         this.setState({arrayIndex:0});
         this.setState({activate:false})
      } else {
         this.setState({postContent:this.state.postData[this.state.arrayIndex].content.rendered});
         this.setState({postTitle:this.state.postData[this.state.arrayIndex].title.rendered});
         this.setState({arrayIndex:this.state.arrayIndex + 1});
      };
   },
   buttonText:function() {
      if(this.state.arrayIndex===0) {
         return "Load Blog";
      } else {
         return "Next Post"
      }
   },
   nextPage: function() {
      browserHistory.push('/test');
   },
   createMarkup: function() {
      return {__html: 'First &middot; Second'};
   },
   animateBlog: function() {
      if(this.state.activate===true) {
         return "animate-blog";
      }
   },
   render: function() {
      return (
         <div className="page-background">
            <div className="flex-center-center">
               <a className="button" onClick={this.loadBlog}>{this.buttonText()}</a>
            </div>
            <div className={"blog-wrapper container "+this.animateBlog()}>
               <h2>{this.state.postTitle}</h2>
               <div className="blog-content" dangerouslySetInnerHTML={{__html: this.state.postContent}}></div>
            </div>
         </div>
      );
   }

});

module.exports = BlogLoop;
