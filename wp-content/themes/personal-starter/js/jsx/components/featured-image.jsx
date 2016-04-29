var React = require('react');
var PropTypes = React.PropTypes;

var FeaturedImage = React.createClass({
   getInitialState: function() {
      return {
         mediaData:[]
      };
   },
   componentWillUpdate: function() {
      $.ajax({
         datatype:'json',
         method:'GET',
         url:'wp-json/wp/v2/media/'+this.props.imageID,
         success: function(wpData) {
            this.setState({mediaData:wpData});
         }.bind(this)
      });
   },
   render: function() {
      return (
         <div />
      );
   }

});

module.exports = FeaturedImage;
