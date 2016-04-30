var React = require('react');
var PropTypes = React.PropTypes;


var About = React.createClass({
   getInitialState: function() {
      return {
         postData:[],
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
   componentDidMount:function() {
      this.setState({
                     postContent:this.state.postData[0].content.rendered,
                     postTitle:this.state.postData[0].title.rendered,
                     postImageID:this.state.postData[0].featured_image_url});
   },
   render: function() {
      return (
         <div>Hello World</div>
         <div>
            <div className="container">
               <h2>{this.state.postTitle}</h2>
               <div className="" dangerouslySetInnerHTML={{__html: this.state.postContent}}></div>
            </div>
            <div>
            </div>
         </div>
      );
   }
});

   module.exports = About;

   //PropTypes
   //mediaID = the json object for the featured image based on the post
