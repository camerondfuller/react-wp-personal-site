import React, { PropTypes } from 'react';

class PortfolioContent extends React.Component {
   constructor(props){
      super(props);
      this.state = {
         pageTitle:'',
         pageContent:'',
         featuredImageURL:'',
         pageLink:false
      }
   }
   componentWillReceiveProps(nextProps) {
      this.setState({
        pageTitle: nextProps.object[nextProps.arrayIndex].title.rendered,
        pageContent:nextProps.object[nextProps.arrayIndex].content.rendered,
        featuredImageURL:nextProps.object[nextProps.arrayIndex].featured_image_url,
        pageLink:nextProps.object[nextProps.arrayIndex].acf.page_link
      });
   }
   render () {
      return (
         <div className="port-cont-single">
            <div className="port-title">
               <h3>{this.state.pageTitle}</h3>
            </div>
            <div>
               <div className="port-text" dangerouslySetInnerHTML={{ __html: this.state.pageContent}}></div>
               <a href={this.state.pageLink}><img src={this.state.featuredImageURL} className="port-img"/></a>
            </div>
         </div>
      );
   }
}

export default PortfolioContent;
