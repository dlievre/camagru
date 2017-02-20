
function myFunction() {
    var x = document.createElement("FORM");
    x.setAttribute("id", "myForm");
    document.body.appendChild(x);

    var y = document.createElement("INPUT");
    y.setAttribute("type", "text");
    y.setAttribute("value", "Donald");
    document.getElementById("myForm").appendChild(y);
}

var syntax = 
{

	msg1: 'msg1',
	msg2:  'msg2',
	form: function (params) // id:[], action:[action.php], method:[(GET || POST)]
	{
		params = this.splitParams(params);

		id = this.splitValue(params[0])[1];
		action = this.splitValue(params[1])[1];
		method = this.splitValue(params[2])[1];

		var f = document.createElement("FORM");
		f.setAttribute("id", id);
		f.setAttribute("action", action);
		f.setAttribute("method", method);
		document.body.appendChild(f);

	},

	inputText: function (params)
	{
		// First name: <input type="text" name="fname"><br>
		// id:[],label:[], value:[]

		params = this.splitParams(params);

		form = this.splitValue(params[0])[1];
		id = this.splitValue(params[1])[1];
		value = this.splitValue(params[2])[1];

		var y = document.createElement("INPUT");
		y.setAttribute("id", id);
		y.setAttribute("name", id);
	    y.setAttribute("type", "text");
	    y.setAttribute("value", value);

	    para = document.createElement("P");
	    var txt = document.createTextNode(value);
	    para.appendChild(txt);
	    document.getElementById(form).appendChild(para);
	    document.getElementById(form).appendChild(y);
	},

	submit: function (params) // form:[],id:[], value:[]
	{
		//<button type="submit" form="form1" value="Submit">Submit</button>

		params = this.splitParams(params);

		form = this.splitValue(params[0])[1];
		id = this.splitValue(params[1])[1];
		value = this.splitValue(params[2])[1];

		var btn = document.createElement("BUTTON");
		var txt = document.createTextNode(value);
		btn.appendChild(txt);
		document.getElementById(form).appendChild(btn);
	},	

	p: function (params)
	{

		params = this.splitParams(params);

		id = this.splitValue(params[0])[1];
		content = this.splitValue(params[1])[1];
		classe = this.splitValue(params[2])[1];

	    para = document.createElement("P");
	    para.setAttribute("id", id);
	    para.setAttribute("class", classe);
	    var txt = document.createTextNode(content);
	    para.appendChild(txt);
	    //document.getElementById('p').appendChild(para);
	    document.getElementById(form).appendChild(para);
	},

	splitParams: function (tab)
	{
		return tab.split(", ");
	},
	splitValue: function (tab)
	{
		return tab.split(":");
	}

};
