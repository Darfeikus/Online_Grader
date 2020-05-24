import { NgModule } from "@angular/core";
import { AlertModule } from "ngx-bootstrap/alert";
import { BsDropdownModule } from "ngx-bootstrap/dropdown";
import { TabsModule } from "ngx-bootstrap/tabs";
import { PaginationModule } from "ngx-bootstrap/pagination";
import { ChartsModule } from "ng2-charts";
import { AssignmentsComponent } from "./assignments.component";
import { AssignmentsRoutingModule } from "./assignments-routing/assignments-routing.module";
@NgModule({
  imports: [
    AssignmentsRoutingModule,
    ChartsModule,
    BsDropdownModule.forRoot(),
    TabsModule.forRoot(),
    PaginationModule.forRoot(),
    AlertModule.forRoot(),
  ],
  declarations: [AssignmentsComponent],
  providers: [],
})
export class AssignmentsModule {}