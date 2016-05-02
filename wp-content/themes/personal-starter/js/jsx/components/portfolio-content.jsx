var React = require('react');
var PropTypes = React.PropTypes;

var PageContent = React.createClass({
   getInitialState: function() {
      return {
         pageTitle:'',
         pageContent:'',
         featuredImageURL:''
      };
   },
   componentWillReceiveProps: function(nextProps) {
         this.setState({
           pageTitle: nextProps.object[nextProps.arrayIndex].title.rendered,
           pageContent:nextProps.object[nextProps.arrayIndex].content.rendered,
           featuredImageURL:nextProps.object[nextProps.arrayIndex].featured_image_url
         });
     },
   render: function() {
      return (
         <div>
            <div>
               <h2>{this.state.pageTitle}</h2>
            </div>
            <div className="container">
               <div className="portfolio-text" dangerouslySetInnerHTML={{ __html: this.state.pageContent}}></div>
               <img src={this.state.featuredImageURL} />
            </div>
         </div>
      );
   }

});

module.exports = PageContent;
