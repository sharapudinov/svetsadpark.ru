{"version":3,"file":"bizproc.min.js","sources":["bizproc.js"],"names":["DragNDrop","in_array","ar","str","i","length","CreateActivity","oActivity","Type","t","a","arAllActivities","toLowerCase","eval","Properties","Array","k","properties","BX","clone","hasOwnProperty","Icon","window","UnknownBizProcActivity","Init","JSToPHPHidd","v","ob","varname","BPDesignerUseJson","JSON","stringify","res","key","isSimpleArray","parseInt","JSToPHP","encodeURIComponent","push","join","ActGetRealPos","el","offsetParent","pos","XMLEncode","String","replace","HTMLEncode","GenUniqId","Math","random","FindActivityById","template","id","Name","Children","_crt","r","c","j","row","cell","document","createElement","width","cellSpacing","cellPadding","border","insertRow","insertCell","align","vAlign","BizProcActivity","this","childActivities","parentActivity","Title","arAllId","height","activity","SerializeToXML","e","s","Serialize","OnRemoveClick","RemoveChild","OnSettingsClick","Settings","CDialog","content_url","MODULE_ID","message","ENTITY","content_post","document_type","arWorkflowParameters","arWorkflowVariables","rootActivity","CURRENT_SITE_ID","bitrix_sessid","Show","RemoveResources","self","div","parentNode","removeChild","ch","pop","BPTemplateIsModified","SetError","setFocus","className","scrollToNode","Draw","divC","appendChild","d1","d11","d111","a1","onclick","a2","OnHideClick","a3","sp","style","padding","cursor","onmousedown","event","StartDrag","innerHTML","offsetWidth","d2","backgroundColor","borderLeft","borderRight","overflowX","overflowY","activityHeight","ondblclick","activityContent","act","background","margin","paddingLeft","textAlign","setAttribute","d3","d33","d333","activityWidth","CheckFields","SetHeight","iHeight","findChildById","found","_DragNDrop","drdrop","antiselect","dragging","GetDrDr","body","display","position","zIndex","MozOpacity","opacity","filter","fontSize","left","top","MozUserSelect","jsUtils","addEvent","Dragging","Drop","obj","windowSize","GetWindowScrollSize","scrollWidth","scrollHeight","scrollPos","GetWindowScrollPos","clientY","scrollTop","clientX","scrollLeft","Handlers","AddHandler","eventName","func","RemoveHandler","fixEventPageXY","X","pageX","Y","pageY","scrollSize","GetWindowInnerSize","innerHeight","scrollBy","innerWidth","selection","empty","getSelection","removeAllRanges","_UnS","setTimeout","namespace","Bizproc","cloneTypeControl","tableID","tbl","getElementById","cnt","rows","oRow","oCell","sHTML","cells","p","n","indexOf","substr","pattern","RegExp","code","match","substring","EvalGlobal","cloneTypeControlHtml","wrapperId","ajax","method","dataType","url","onsuccess","HTML"],"mappings":"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"}