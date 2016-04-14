var React = require('react');
var PropTypes = React.PropTypes;
import {browserHistory} from 'react-router';


var BlogLoop = React.createClass({
   getInitialState: function() {
      return {
         postData:[],
         postContent:'',
         postTitle:'',
         arrayIndex:0
      };
   },
   componentDidMount: function() {
      $.ajax({
         datatype:'json',
         method:'GET',
         url:'http://camerondfuller.dev/wp-json/wp/v2/posts',
         success: function(wpData) {
            this.setState({postData:wpData});
         }.bind(this)
      })
   },
   testMethod:function() {
      this.setState({postContent:this.state.postData[this.state.arrayIndex].content.rendered});
      this.setState({postTitle:this.state.postData[this.state.arrayIndex].title.rendered});
      if(this.state.arrayIndex ===9){
         this.setState({arrayIndex:0});
      } else {
         this.setState({arrayIndex:this.state.arrayIndex + 1});
      }
   },
   nextPage: function() {
      browserHistory.push('/test');
   },
   render: function() {
      return (
         <div>
            <p>
               This is generated dynamically through react!
            </p>
            <p>
               <a onClick={this.testMethod}>Load Blog</a>
               <h2>{this.state.postTitle}</h2>
               {this.state.postContent}
            </p>
            <p>
               <a onClick={this.nextPage}>Test</a>
            </p>
         </div>
      );
   }

});

module.exports = BlogLoop;
