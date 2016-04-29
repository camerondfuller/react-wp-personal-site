var React = require('react');
var PropTypes = React.PropTypes;


var Page = React.createClass({
   getInitialState: function() {
      return {
         postData:[],
         loaded:false,
         activate:false,
         arrayIndex:0
      };
   },
   componentWillMount: function() {
      $.ajax({
         datatype:'json',
         method:'GET',
         url:'wp-json/wp/v2/pages/',
         success: function(wpData) {
            this.setState({postData:wpData});
         }.bind(this)
      });
   },
   loadPage:function() {
      this.setState({loaded:true,
                     activate:true,
                     postContent:this.state.postData[this.state.arrayIndex].content.rendered,
                     postTitle:this.state.postData[this.state.arrayIndex].title.rendered,
                     postImageID:this.state.postData[this.state.arrayIndex].featured_image_url});
   },
   closePage:function() {
      this.setState({activate:false})
   },
   animateBlog: function() {
      if(!this.state.activate) {
         return "hide-blog";
      } else {
         return "animate-blog";
      }
   },
   render: function() {
      return (
         <div>
            <div className="">
               <a className="button about-btn" onClick={this.loadPage}>About Me</a>
            </div>
            <div className={"blog-wrapper container "+this.animateBlog()}>
               <div className="close" onClick={this.closePage}><i className="fa fa-close"></i></div>
               <h2>{this.state.postTitle}</h2>
               <div className="blog-content" dangerouslySetInnerHTML={{__html: this.state.postContent}}></div>
            </div>
            <div>
               <img src={this.state.postImageID}/>
            </div>
         </div>
      );
   }
});

   module.exports = Page;

   //PropTypes
   //mediaID = the json object for the featured image based on the post
