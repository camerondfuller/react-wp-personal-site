var React = require('react');
var PropTypes = React.PropTypes;

var FeaturedImage = React.createClass({
   getInitialState: function() {
      return {
         mediaData:{},
         sourceURL:''
      };
   },
   componentDidMount: function() {
      $.ajax({
         datatype:'json',
         method:'GET',
         url:'wp-json/wp/v2/media/'+this.props.mediaID,
         success: function(wpData) {
            this.setState({mediaData:wpData});
         }.bind(this)
      });
   },
   componentWillReceiveProps: function(newProps){
      if (newProps.setImage === true) {
         this.setState({sourceURL:this.state.mediaData.source_url})
      };
   },
   render: function() {
      return (
         <div>
            <img src={this.state.sourceURL}/>
         </div>
      );
   }

});

module.exports = FeaturedImage;

//PropTypes
//mediaID = the json object for the featured image based on the post
