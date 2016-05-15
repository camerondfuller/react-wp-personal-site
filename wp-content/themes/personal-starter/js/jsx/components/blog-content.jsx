import React, { PropTypes } from 'react';

class BlogContent extends React.Component {
   constructor(props) {
      super(props);
      this.state = {
         postContent:'',
         postTitle:'',
         postImage:'',
         arrayIndex:this.props.arrayIndex,
         activate: false
      }
   }
   componentWillReceiveProps(nextProps) {
      this.setState({
         arrayIndex:nextProps.arrayIndex,
         postContent:nextProps.object[this.state.arrayIndex].content.rendered,
         postTitle:nextProps.object[this.state.arrayIndex].title.rendered,
         postImage:nextProps.object[this.state.arrayIndex].featured_image_url
      })
   }
   componentDidUpdate(prevProps, prevState) {
      this.setState({
         postContent:this.props.object[this.state.arrayIndex].content.rendered,
         postTitle:this.props.object[this.state.arrayIndex].title.rendered,
         postImage:this.props.object[this.state.arrayIndex].featured_image_url
      });
   }
   _imageClass(){
      if(this.state.postImage !== null) {
         return "blog-image";
      }
   }
   render() {
      return (
         <div>
            <h2 dangerouslySetInnerHTML={{__html: this.state.postTitle}}></h2>
            <img src={this.state.postImage} className={this._imageClass()}/>
            <div className="blog-content" dangerouslySetInnerHTML={{__html: this.state.postContent}}></div>
         </div>
      )
   }
}

export default BlogContent;
