import React, { PropTypes } from 'react';

class PageContent extends React.Component {
   constructor(props) {
      super(props);
      this.state = {
         pageTitle:'',
         pageContent:'',
         featuredImageURL:''
      }
   }
   componentWillReceiveProps(nextProps) {
      this.setState({
        pageTitle: nextProps.object[this.props.arrayIndex].title.rendered,
        pageContent:nextProps.object[this.props.arrayIndex].content.rendered,
        featuredImageURL:nextProps.object[this.props.arrayIndex].featured_image_url
      });
   }
   render () {
      return (
         <div>
            <div className="about-title">
               <h2 dangerouslySetInnerHTML={{__html: this.state.pageTitle}}></h2>
            </div>
            <div className="about-cont">
               <img src={this.state.featuredImageURL} alt="a picture of Cameron Fuller" className="about-img"/>
               <div className="about-content" dangerouslySetInnerHTML={{ __html: this.state.pageContent}}></div>
            </div>
         </div>
      );
   }
}

export default PageContent;
