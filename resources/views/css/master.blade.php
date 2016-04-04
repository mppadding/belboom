html, body {
	height: 100%;
	margin: 0;
	font-family: 'RobotoDraft', sans-serif;
	color: #{{ $color_text_primary }};
}

hr {
	border: 0;
	height: 1px;
}

paper-button {
	background: #{{ $color_accent }};
	color: #{{ $color_icons }};
	font-size: 17px;
}

paper-input-decorator /deep/ ::-webkit-input-placeholder,
paper-input-decorator /deep/ ::-moz-placeholder,
paper-input-decorator /deep/ ::-ms-input-placeholder,
paper-input-decorator /deep/ .label-text,
paper-input-decorator /deep/ .error,
paper-input-decorator[focused] /deep/ .floated-label .label-text {
	color: #{{ $color_text_secondary }};
}

paper-input-decorator /deep/ .unfocused-underline, hr {
	background-color: #{{ $color_divider }};
}

paper-input-decorator /deep/ .focused-underline {
	background-color: #{{ $color_accent }};
}

.header, paper-tabs, core-toolbar {
	background-color: #{{ $color_primary }};
	color: #{{ $color_icons }};
}

paper-tabs::shadow #selectionBar {
  	background-color: #{{ $color_accent }};
}

paper-tabs paper-tab::shadow #ink {
  	color: #{{ $color_light_primary }};
}

paper-tabs a {
	color: #{{ $color_icons }};
}

core-drawer-panel core-header-panel {
	background: white;
}
paper-fab {
	position: fixed;
	bottom: 32px;
	right: 32px;
	background: #{{ $color_accent }};
	-webkit-transform: translateZ(0);
}


.header {
	font-size: 50px;
	font-weight: 900;
}
paper-tabs a {
	text-decoration: none;
	font-size: 20px;
	font-weight: 700;
}
@media all and (max-height: 360px) {
	paper-tabs a {
		font-size: 18px;
	}
}

@media all and (max-width: 598px) {
	paper-tabs a {
		font-size: 16px;
	}
}

@media all and (max-width: 640px) {
    .header {
        font-size: 30px;
    }
}