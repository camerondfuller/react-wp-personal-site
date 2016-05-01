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
         postContent:nextProps.object[this.state.arrayIndex].content.rendered,
         postTitle:nextProps.object[this.state.arrayIndex].title.rendered,
         postImage:nextProps.object[this.state.arrayIndex].featured_image_url,
         arrayIndex:nextProps.arrayIndex
      })
   },
   render: function() {
      return (
         <div>
            <div>
               <h2>{this.state.postTitle}</h2>
               <img src={this.state.postImage} className="blog-image"/>
               <div className="blog-content" dangerouslySetInnerHTML={{__html: this.state.postContent}}></div>
            </div>
         </div>
      );
   }

});

module.exports = BlogContent;
