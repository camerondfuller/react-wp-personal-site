var React = require('react');
var PropTypes = React.PropTypes;

var BlogContent = React.createClass({
   getInitialState: function() {
      return {
         postContent:'',
         postTitle:'',
         postImage:'',
         arrayIndex:this.props.arrayIndex,
         activate: false
      };
   },
   componentWillReceiveProps: function(nextProps) {
      this.setState({
         arrayIndex:nextProps.arrayIndex,
         postContent:nextProps.object[this.state.arrayIndex].content.rendered,
         postTitle:nextProps.object[this.state.arrayIndex].title.rendered,
         postImage:nextProps.object[this.state.arrayIndex].featured_image_url
      })
   },
   imageClass: function() {
      if(this.state.postImage !== null) {
         return "blog-image";
      }
   },
   render: function() {
      return (
         <div>
            <h2 dangerouslySetInnerHTML={{__html: this.state.postTitle}}></h2>
            <img src={this.state.postImage} className={this.imageClass()}/>
            <div className="blog-content" dangerouslySetInnerHTML={{__html: this.state.postContent}}></div>
         </div>
      );
   }

});

module.exports = BlogContent;
