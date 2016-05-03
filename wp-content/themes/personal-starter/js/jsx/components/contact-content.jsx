var React = require('react');
var PropTypes = React.PropTypes;

var ContactContent = React.createClass({
   getInitialState: function() {
      return {
         pageTitle:'',
         pageContent:''
      };
   },
   componentWillReceiveProps: function(nextProps) {
         this.setState({
           pageTitle: nextProps.object[nextProps.arrayIndex].title.rendered,
           pageContent:nextProps.object[nextProps.arrayIndex].content.rendered,
         });
     },
   render: function() {
      return (
            <div className="double-column container">
               <div className="single-column" dangerouslySetInnerHTML={{__html: this.state.pageContent}}></div>
            </div>
      );
   }

});

module.exports = ContactContent;
