.login {
    margin-top: 50px;
}

.content {
    min-width: 30vw;
}

.content .title {
	text-align: center;
	padding-top: 2%;
	font-size: 18px;
	color: #{{ $color_text_primary }};
}

form > div.input {
    margin: 0px 10px 10px 10px;
}

.input .icon {
    margin-top: 35px;
    margin-right: 10px;
    float: left;
}

.submit {
    margin-bottom: 10px;
}

.wrapper {
    text-align: center;
}

.content {
    display: inline-block;
}

@media all and (max-width: 360px) {
    .wrapper, .content {
        display: block;
    }
    .content {
        margin-left: 10%;
        width: 80%;
    }
    .content {
        text-align: center;
    }
}
@media all and (min-width: 361px) {
    paper-input-decorator {
    	max-width: 30vw;
    }
}
core-selector > .item {
	padding: 4px 4px 4px 10px;
	text-align: left;
}
core-selector > .item.core-selected {
	font-style: italic;
	background: #{{ $color_accent }};
	color: #{{ $color_icons }};
}

paper-checkbox::shadow #checkbox.checked {
    background-color: #{{ $color_accent }};
    border-color: #{{ $color_accent }};
}

.input_icon {
    width:  32px;
    height: 32px;
    color:  #{{ $color_text_secondary }};
}