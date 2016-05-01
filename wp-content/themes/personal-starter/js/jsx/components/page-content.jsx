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
           pageTitle: nextProps.object[0].title.rendered,
           pageContent:nextProps.object[0].content.rendered,
           featuredImageURL:nextProps.object[0].featured_image_url
         });
     },
   render: function() {
      return (
         <div>
            <div>
               <h2>{this.state.pageTitle}</h2>
            </div>
            <div className="container">
               <img src={this.state.featuredImageURL} alt="a picture of Cameron Fuller" className="about-img"/>
               <div dangerouslySetInnerHTML={{ __html: this.state.pageContent}}></div>
            </div>
         </div>
      );
   }

});

module.exports = PageContent;
